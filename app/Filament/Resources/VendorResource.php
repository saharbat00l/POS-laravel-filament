<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Vendor;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use League\CommonMark\Input\MarkdownInput;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\VendorResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use League\CommonMark\Input\MarkdownInputInterface;
use App\Filament\Resources\VendorResource\RelationManagers;

class VendorResource extends Resource
{
    protected static ?string $model = Vendor::class;
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function getNavigationBadge(): ?string
    {
        return Vendor::count();
    }

    public static function form(Form $form): Form
    {
        $vendors = Vendor::orderBy('business_name','asc')->get()->pluck('business_name','id');
       return $form
            ->schema([
                // $form->belongsTo('parent_id', 'Parent Vendor')->filters('vendor_id', 'business_name'),
                // Select::make('vendor_id')->required()->options($vendors),
                TextInput::make('business_name')->required(),
                TextInput::make('person_name'),
                TextInput::make('address1')->required(),
                TextInput::make('address2'),
                TextInput::make('contact1')->required(),
                TextInput::make('contact2'),
                TextInput::make('business_email')->required(),
                TextInput::make('personal_email'),
                // MarkdownEditor::make('description')->required(),
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
                // TextColumn::make('description')
                // ->description(fn (Vendor $record): string => $record->description)
                // ->markdown(),
            // TextColumn::make('personal_email')
            //     ->searchable(),
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
            'index' => Pages\ListVendors::route('/'),
            'create' => Pages\CreateVendor::route('/create'),
            'edit' => Pages\EditVendor::route('/{record}/edit'),
        ];
    }    
}
