<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Models\JobBatchManager;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use App\Filament\Filters\DateRangeFilter;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\JobBatchManagerResource\Pages;

class JobBatchManagerResource extends Resource
{
    protected static ?string $model = JobBatchManager::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('batch_id')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Batch Id')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('name')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Name')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('total_jobs')
                        ->rules(['numeric'])
                        ->required()
                        ->numeric()
                        ->placeholder('Total Jobs')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('pending_jobs')
                        ->rules(['numeric'])
                        ->required()
                        ->numeric()
                        ->placeholder('Pending Jobs')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('failed_jobs')
                        ->rules(['numeric'])
                        ->required()
                        ->numeric()
                        ->placeholder('Failed Jobs')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    RichEditor::make('failed_job_ids')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Failed Job Ids')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    RichEditor::make('options')
                        ->rules(['max:255', 'string'])
                        ->nullable()
                        ->placeholder('Options')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    DatePicker::make('cancelled_at')
                        ->rules(['date'])
                        ->nullable()
                        ->placeholder('Cancelled At')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    DatePicker::make('finished_at')
                        ->rules(['date'])
                        ->nullable()
                        ->placeholder('Finished At')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('status')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Status')
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
                Tables\Columns\TextColumn::make('batch_id')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('name')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('total_jobs')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('pending_jobs')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('failed_jobs')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('failed_job_ids')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('options')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('cancelled_at')
                    ->toggleable()
                    ->date(),
                Tables\Columns\TextColumn::make('finished_at')
                    ->toggleable()
                    ->date(),
                Tables\Columns\TextColumn::make('status')
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobBatchManagers::route('/'),
            'create' => Pages\CreateJobBatchManager::route('/create'),
            'view' => Pages\ViewJobBatchManager::route('/{record}'),
            'edit' => Pages\EditJobBatchManager::route('/{record}/edit'),
        ];
    }
}
