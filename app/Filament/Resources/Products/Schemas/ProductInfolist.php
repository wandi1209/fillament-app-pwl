<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Product Tab')
                ->tabs([
                    Tab::make('Product Details')
                        ->schema([
                            TextEntry::make('name')
                                ->label('Product Name')
                                ->weight('bold')
                            ->color('primary'),
                            TextEntry::make('id')
                                ->label('Product ID'),
                            TextEntry::make('sku')
                                ->label('Product SKU')
                                ->badge()
                                ->color('warning'),
                            TextEntry::make('description')
                                ->label('Description'),
                            TextEntry::make('created_at')
                                ->label('Product Creation Date')
                                ->date('d M Y'),
                    ]),
                    Tab::make('Pricing & Stock')
                        ->schema([
                            TextEntry::make('price')
                                ->label('Product Price')
                                ->weight('bold')
                                ->color('primary')
                                ->icon('heroicon-o-currency-dollar')
                                ->formatStateUsing(fn ($state) => 'Rp.' . number_format($state, 0, ',', '.')),
                            TextEntry::make('stock')
                                ->label('Product Stock')
                                ->icon('heroicon-o-archive-box'),
                    ]),
                    Tab::make('Media & Status')
                        ->schema([
                            ImageEntry::make('image')
                                    ->label('Product Image')
                                    ->disk('public'),
                                TextEntry::make('price')
                                    ->label('Product Price')
                                    ->weight('bold')
                                    ->color('primary')
                                    ->icon('heroicon-o-currency-dollar')
                                    ->formatStateUsing(fn ($state) => 'Rp.' . number_format($state, 0, ',', '.')),
                                TextEntry::make('stock')
                                    ->label('Product Stock')
                                    ->weight('bold')
                                    ->color('primary'),
                                IconEntry::make('is_active')
                                    ->label('Active')
                                    ->boolean(),
                                IconEntry::make('is_featured')
                                    ->label('Featured')
                                    ->boolean(),
                        ])
                ])->columnSpanFull()->vertical(),
                Section::make('Product Info')
                    ->description('')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Product Name')
                            ->weight('bold')
                            ->color('primary'),
                        TextEntry::make('id')
                            ->label('Product ID'),
                        TextEntry::make('sku')
                            ->label('Product SKU')
                            ->badge()
                            ->color('warning'),
                        TextEntry::make('description')
                            ->label('Description'),
                ])->columnSpanFull(),
                Section::make('Pricing & Stock')
                    ->description('')
                    ->schema([
                        TextEntry::make('price')
                            ->label('Product Price')
                            ->weight('bold')
                            ->color('primary')
                            ->icon('heroicon-o-currency-dollar')
                            ->formatStateUsing(fn ($state) => 'Rp.' . number_format($state, 0, ',', '.')),
                        TextEntry::make('stock')
                            ->label('Product Stock')
                            ->icon('heroicon-o-archive-box'),
                ])->columnSpanFull(),
                Section::make('Media & Status')
                    ->description('')
                    ->schema([
                        ImageEntry::make('image')
                            ->label('Product Image')
                            ->disk('public'),
                        TextEntry::make('price')
                            ->label('Product Price')
                            ->weight('bold')
                            ->color('primary')
                            ->icon('heroicon-o-currency-dollar'),
                        TextEntry::make('stock')
                            ->label('Product Stock')
                            ->weight('bold')
                            ->color('primary'),
                        IconEntry::make('is_active')
                            ->label('Active')
                            ->boolean(),
                        IconEntry::make('is_featured')
                            ->label('Featured')
                            ->boolean()
                ])->columnSpanFull(),
            ]);
    }
}
