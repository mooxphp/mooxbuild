<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Platform;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use App\Filament\Filters\DateRangeFilter;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\PlatformResource\Pages;

class PlatformResource extends Resource
{
    protected static ?string $model = Platform::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('title')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Title')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('slug')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Slug')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('domain')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Domain')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Toggle::make('selection')
                        ->rules(['boolean'])
                        ->nullable()
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('order')
                        ->rules(['max:255'])
                        ->nullable()
                        ->placeholder('Order')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Toggle::make('locked')
                        ->rules(['boolean'])
                        ->nullable()
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Toggle::make('master')
                        ->rules(['boolean'])
                        ->nullable()
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    FileUpload::make('thumbnail')
                        ->rules(['file'])
                        ->nullable()
                        ->image()
                        ->placeholder('Thumbnail')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('platformable_id')
                        ->rules(['max:255'])
                        ->required()
                        ->placeholder('Platformable Id')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('platformable_type')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Platformable Type')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('60s')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('slug')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('domain')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\IconColumn::make('selection')
                    ->toggleable()
                    ->boolean(),
                Tables\Columns\TextColumn::make('order')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\IconColumn::make('locked')
                    ->toggleable()
                    ->boolean(),
                Tables\Columns\IconColumn::make('master')
                    ->toggleable()
                    ->boolean(),
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->toggleable()
                    ->circular(),
                Tables\Columns\TextColumn::make('platformable_id')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('platformable_type')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
            ])
            ->filters([DateRangeFilter::make('created_at')])
            ->actions([ViewAction::make(), EditAction::make()])
            ->bulkActions([DeleteBulkAction::make()]);
    }

    public static function getRelations(): array
    {
        return [
            PlatformResource\RelationManagers\SyncsRelationManager::class,
            PlatformResource\RelationManagers\SyncsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlatforms::route('/'),
            'create' => Pages\CreatePlatform::route('/create'),
            'view' => Pages\ViewPlatform::route('/{record}'),
            'edit' => Pages\EditPlatform::route('/{record}/edit'),
        ];
    }
}
