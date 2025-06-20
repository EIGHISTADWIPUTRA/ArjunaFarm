<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationLabel = 'Products';
    protected static ?string $pluralModelLabel = 'Products';
    protected static ?string $modelLabel = 'Product';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->required(),
                TextInput::make('facility')
                    ->required()
                    ->maxLength(255),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
                FileUpload::make('image')
                    ->label('Image')
                    ->image() // Membatasi hanya gambar
                    ->directory('products') // Menyimpan gambar di dalam folder 'products'
                    ->disk('public') // Menyimpan di disk 'public'
                    ->preserveFilenames() // Menyimpan dengan nama asli
                    ->maxSize(2048) // Ukuran maksimal file dalam KB
                    ->visibility('public') // Menyimpan file dengan visibilitas public
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('image')
                    ->label('Image')
                    ->formatStateUsing(fn ($state) => '<img src="' . asset('storage/' . $state) . '" style="height: 60px; border-radius: 50%;" />')
                    ->html(),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('description')->limit(50),
                TextColumn::make('facility')->label('Facility'),
                TextColumn::make('price')
                    ->label('Price')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 2, ',', '.'))
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->label('Created'),
            ])
            ->filters([
                // Optional: tambahkan filter jika dibutuhkan
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Tambahkan relasi jika ada
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
