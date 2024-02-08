<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\JobManager;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\JobManagerResource\Pages;

class JobManagerResource extends Resource
{
    protected static ?string $model = JobManager::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('job_id')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Job Id')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('name')
                        ->rules(['max:255', 'string'])
                        ->nullable()
                        ->placeholder('Name')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('queue')
                        ->rules(['max:255', 'string'])
                        ->nullable()
                        ->placeholder('Queue')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    DatePicker::make('available_at')
                        ->rules(['date'])
                        ->required()
                        ->placeholder('Available At')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    DatePicker::make('started_at')
                        ->rules(['date'])
                        ->nullable()
                        ->placeholder('Started At')
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

                    Toggle::make('failed')
                        ->rules(['boolean'])
                        ->required()
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('attempt')
                        ->rules(['numeric'])
                        ->required()
                        ->numeric()
                        ->placeholder('Attempt')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('progress')
                        ->rules(['numeric'])
                        ->nullable()
                        ->numeric()
                        ->placeholder('Progress')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    RichEditor::make('exception_message')
                        ->rules(['max:255', 'string'])
                        ->nullable()
                        ->placeholder('Exception Message')
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

                    Select::make('job_queue_worker_id')
                        ->rules(['exists:job_queue_workers,id'])
                        ->required()
                        ->relationship('jobQueueWorker', 'worker_pid')
                        ->searchable()
                        ->placeholder('Job Queue Worker')
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
                Tables\Columns\TextColumn::make('job_id')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('name')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('queue')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('available_at')
                    ->toggleable()
                    ->date(),
                Tables\Columns\TextColumn::make('started_at')
                    ->toggleable()
                    ->date(),
                Tables\Columns\TextColumn::make('finished_at')
                    ->toggleable()
                    ->date(),
                Tables\Columns\IconColumn::make('failed')
                    ->toggleable()
                    ->boolean(),
                Tables\Columns\TextColumn::make('attempt')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('progress')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('exception_message')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('status')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('jobQueueWorker.worker_pid')
                    ->toggleable()
                    ->limit(50),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('job_queue_worker_id')
                    ->relationship('jobQueueWorker', 'worker_pid')
                    ->indicator('JobQueueWorker')
                    ->multiple()
                    ->label('JobQueueWorker'),
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
            'index' => Pages\ListJobManagers::route('/'),
            'create' => Pages\CreateJobManager::route('/create'),
            'view' => Pages\ViewJobManager::route('/{record}'),
            'edit' => Pages\EditJobManager::route('/{record}/edit'),
        ];
    }
}
