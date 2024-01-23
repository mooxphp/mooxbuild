<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Sync;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\SyncResource\Pages;

class SyncResource extends Resource
{
    protected static ?string $model = Sync::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'syncable_type';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('syncable_id')
                        ->rules(['max:255'])
                        ->required()
                        ->placeholder('Syncable Id')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('syncable_type')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Syncable Type')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('source_platform_id')
                        ->rules(['exists:platforms,id'])
                        ->required()
                        ->relationship('sourcePlatform', 'title')
                        ->searchable()
                        ->placeholder('Source Platform')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('target_platform_id')
                        ->rules(['exists:platforms,id'])
                        ->required()
                        ->relationship('targetPlatform', 'title')
                        ->searchable()
                        ->placeholder('Target Platform')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    DatePicker::make('last_sync')
                        ->rules(['date'])
                        ->required()
                        ->placeholder('Last Sync')
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
                Tables\Columns\TextColumn::make('syncable_id')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('syncable_type')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('sourcePlatform.title')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('targetPlatform.title')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('last_sync')
                    ->toggleable()
                    ->date(),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('source_platform_id')
                    ->relationship('sourcePlatform', 'title')
                    ->indicator('Platform')
                    ->multiple()
                    ->label('Platform'),

                SelectFilter::make('target_platform_id')
                    ->relationship('targetPlatform', 'title')
                    ->indicator('Platform')
                    ->multiple()
                    ->label('Platform'),
            ])
            ->actions([ViewAction::make(), EditAction::make()])
            ->bulkActions([DeleteBulkAction::make()]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSyncs::route('/'),
            'create' => Pages\CreateSync::route('/create'),
            'view' => Pages\ViewSync::route('/{record}'),
            'edit' => Pages\EditSync::route('/{record}/edit'),
        ];
    }
}
