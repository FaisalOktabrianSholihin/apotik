<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\DetailPenjualan;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DetailPenjualanResource\Pages;
use App\Filament\Resources\DetailPenjualanResource\RelationManagers;

class DetailPenjualanResource extends Resource
{
    protected static ?string $model = DetailPenjualan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Menu Transaksi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Select::make('penjualan_id')
                            ->relationship('penjualan', 'tanggal_penjualan')
                            ->searchable()
                            ->preload()
                            ->label('Pemnjualan')
                            ->required(),
                        Select::make('obat_id')
                            ->relationship('obat', 'nama')
                            ->searchable()
                            ->preload()
                            ->label('Obat')
                            ->required(),
                        TextInput::make('jumlah')
                            ->numeric()
                            ->label('Jumlah')
                            ->default(0),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('penjualan.tanggal_penjualan')->label('Tanggal Penjualan')->sortable()->searchable(),
                TextColumn::make('obat.nama')->label('Nama Obat')->sortable()->searchable(),
                TextColumn::make('jumlah')->sortable()->searchable(),
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
            'index' => Pages\ListDetailPenjualans::route('/'),
            'create' => Pages\CreateDetailPenjualan::route('/create'),
            'edit' => Pages\EditDetailPenjualan::route('/{record}/edit'),
        ];
    }
}
