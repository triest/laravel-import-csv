<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class CustomersImport implements ToModel, WithValidation, SkipsOnFailure,WithStartRow, WithCustomCsvSettings
{

    use Importable, SkipsFailures;

    public function startRow(): int
    {
        return 2;
    }

    public function getCsvSettings(): array
    {
        return [
                'delimiter' => ';'
        ];
    }

    /**
    * @param array $row
    *
    * @return Customer
     */
    public function model(array $row)
    {
        return new Customer([
            'id' => $row['id'],
            'name' => $row['name'],
            'email' => $row['email'],
            'age' => $row['age'],
        ]);
    }

    public function rules(): array
    {
        return  [
          'name' => 'string',
          'email' => 'string|email:rfc,dns',
           'age' => 'min:18|max:99'
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        // TODO: Implement onFailure() method.
    }
}
