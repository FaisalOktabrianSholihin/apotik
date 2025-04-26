<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Obat;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ObatResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ObatResource\RelationManagers;

class ObatResource extends Resource
{
    protected static ?string $model = Obat::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Menu Utama';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('nama'),
                        TextInput::make('stok'),
                        TextInput::make('satuan'),
                        TextInput::make('harga_beli'),
                        TextInput::make('harga_jual'),

                        Select::make('kategori_obat_id')
                            ->relationship('kategori', 'nama') // relasi model + field yang mau ditampilkan
                            ->searchable() // biar bisa cari nama kategori
                            ->preload()    // preload data supaya cepat
                            ->label('Kategori Obat')
                            ->required(),

                        Select::make('supplier_id')
                            ->relationship('supplier', 'nama')
                            ->searchable()
                            ->preload()
                            ->label('Supplier')
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')->sortable()->searchable(),
                TextColumn::make('stok')->sortable()->searchable(),
                TextColumn::make('satuan')->sortable()->searchable(),
                TextColumn::make('harga_beli')->sortable()->searchable(),
                TextColumn::make('harga_jual')->sortable()->searchable(),

                TextColumn::make('kategori.nama')
                    ->label('Kategori Obat')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('supplier.nama')->label('Supplier')->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListObats::route('/'),
            'create' => Pages\CreateObat::route('/create'),
            'edit' => Pages\EditObat::route('/{record}/edit'),
        ];
    }
}
