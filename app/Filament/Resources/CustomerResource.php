<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Customer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\CustomerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CustomerResource\RelationManagers;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function getNavigationBadge(): ?string
    {
        return Customer::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('business_name')->required(),
                TextInput::make('person_name'),
                TextInput::make('address1')->required(),
                TextInput::make('address2'),
                TextInput::make('contact1')->required(),
                TextInput::make('contact2'),
                TextInput::make('business_email')->required(),
                TextInput::make('personal_email'),
                TextInput::make('referred_by')->required(),
                RichEditor::make('description')
                 ->toolbarButtons([
                     'bold',
                     'bulletList',
                     'h2',
                     'h3',
                     'link',
                     'italic',
                     'orderedList',
                     'strike',
                     'table',
                     'codeBlock',
                     'blockquote',
                     'undo',
                     'redo',
                 ])->columnSpanFull(),
                            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('business_name')
                    ->searchable(),
                // TextColumn::make('person_name')
                //     ->searchable(),
                TextColumn::make('address1')
                    ->searchable(),
                // TextColumn::make('address2')
                //     ->searchable(),
                TextColumn::make('contact1')
                    ->searchable(),
                // TextColumn::make('contact2')
                //     ->searchable(),
                TextColumn::make('business_email')
                    ->searchable(),
                // TextColumn::make('personal_email')
                //     ->searchable(),
                TextColumn::make('referred_by')
                    ->searchable(),
                // TextColumn::make('description')
                //     ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }    
}
