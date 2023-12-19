<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator;

class InvoiceValidator
{
    public function validate(array $data)
    {
        return Validator::make($data, [
            'amount' => 'required|numeric|min:0',
            'sender_cnpj' => 'required|digits:14|',
            'sender_name' => 'required|max:100',
            'transporter_cnpj' => 'required|digits:14',
            'transporter_name' => 'required|max:100',
        ], [
            'sender_cnpj.required' => 'O campo CNPJ do remetente é obrigatório.',
            'sender_cnpj.digits' => 'O campo CNPJ do remetente deve conter 14 dígitos.',
            'sender_name.required' => 'O campo nome do remetente é obrigatório.',
            'sender_name.max' => 'O campo nome do remetente deve ter no máximo 100 caracteres.',
            'transporter_cnpj.required' => 'O campo CNPJ do transportador é obrigatório.',
            'transporter_cnpj.digits' => 'O campo CNPJ do transportador deve conter 14 dígitos.',
            'transporter_name.required' => 'O campo nome do transportador é obrigatório.',
            'transporter_name.max' => 'O campo nome do transportador deve ter no máximo 100 caracteres.',
        ])->validate();
    }
}
