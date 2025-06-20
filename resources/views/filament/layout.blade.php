<x-filament-panels::layout>
    <style>
        /* Arjuna Farm Green Theme */
        .fi-topbar {
            background-color: #16a34a !important;
            color: white !important;
        }
        
        .fi-sidebar {
            background-color: #14532d !important;
        }
        
        .fi-sidebar-nav-item-label {
            color: #bbf7d0 !important;
        }
        
        .fi-sidebar-nav-item:hover {
            background-color: #166534 !important;
        }
        
        .fi-logo {
            color: #4ade80 !important;
            font-weight: bold !important;
        }
    </style>
    
    {{ $slot }}
</x-filament-panels::layout>