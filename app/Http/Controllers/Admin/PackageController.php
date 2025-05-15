<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePackageRequest;
use App\Http\Requests\Admin\UpdatePackageRequest;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PackageController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of the packages.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Package::query();

        // Search by name
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        // Filter by type
        if ($request->has('type') && in_array($request->input('type'), ['personal', 'rombongan'])) {
            $query->where('type', $request->input('type'));
        }

        // Filter by status
        if ($request->has('status') && in_array($request->input('status'), ['active', 'inactive'])) {
            $query->where('is_active', $request->input('status') === 'active');
        }

        // Sort by column
        $sortColumn = $request->input('sort', 'created_at');
        $sortDirection = $request->input('direction', 'desc');

        if (in_array($sortColumn, ['name', 'price', 'type', 'created_at'])) {
            $query->orderBy($sortColumn, $sortDirection === 'asc' ? 'asc' : 'desc');
        }

        $packages = $query->paginate(10)->appends(request()->query());

        return view('admin.packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new package.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.packages.create');
    }

    /**
     * Store a newly created package in storage.
     *
     * @param  \App\Http\Requests\Admin\StorePackageRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePackageRequest $request)
    {
        // Get validated data
        $data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('packages', 'public');
            $data['image'] = $imagePath;
        }

        // Create package
        $package = Package::create($data);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket berhasil dibuat.');
    }

    /**
     * Display the specified package.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\View\View
     */
    public function show(Package $package)
    {
        return view('admin.packages.show', compact('package'));
    }

    /**
     * Show the form for editing the specified package.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\View\View
     */
    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    /**
     * Update the specified package in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdatePackageRequest  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePackageRequest $request, Package $package)
    {
        // Get validated data
        $data = $request->validated();

        // Handle image upload if a new one is provided
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($package->image) {
                Storage::disk('public')->delete($package->image);
            }

            // Store new image
            $imagePath = $request->file('image')->store('packages', 'public');
            $data['image'] = $imagePath;
        }

        // Update package
        $package->update($data);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket berhasil diperbarui.');
    }

    /**
     * Remove the specified package from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Package $package)
    {
        // Check if package is being used in any orders
        $hasOrders = $package->orderItems()->exists();

        if ($hasOrders) {
            return back()->with('error', 'Paket ini tidak dapat dihapus karena sudah digunakan dalam pesanan.');
        }

        // Delete image if it exists
        if ($package->image) {
            Storage::disk('public')->delete($package->image);
        }

        // Delete package
        $package->delete();

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket berhasil dihapus.');
    }

    /**
     * Toggle the active status of the package.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleStatus(Package $package)
    {
        $package->is_active = !$package->is_active;
        $package->save();

        $status = $package->is_active ? 'aktif' : 'tidak aktif';

        return back()->with('success', "Status paket berhasil diubah menjadi {$status}.");
    }
}
