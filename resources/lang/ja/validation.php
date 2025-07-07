<?php

return [
    'required' => ':attribute は必須項目です。',
    'string' => ':attribute は文字列で入力してください。',
    'max' => [
        'string' => ':attribute は :max 文字以内で入力してください。',
        'file' => ':attribute は :max KB 以下のファイルにしてください。',
    ],
    'image' => ':attribute は画像ファイルである必要があります。',
    'mimes' => ':attribute は :values タイプのファイルでなければなりません。',
    'exists' => '選択された :attribute は無効です。',
    'email' => ':attribute は有効なメールアドレス形式で入力してください。',
    'numeric' => ':attribute は数値で入力してください。',
    'integer' => ':attribute は整数で入力してください。',
    'confirmed' => ':attribute の確認が一致しません。',
    'unique' => ':attribute はすでに使用されています。',
    'min' => [
        'string' => ':attribute は :min 文字以上で入力してください。',
        'file' => ':attribute は :min KB 以上のファイルにしてください。',
    ],
    'attributes' => [
        'name' => '店舗名',
        'description' => '説明',
        'category_id' => 'カテゴリ',
        'image' => '画像',
        'price_min' => '金額下限',
        'price_max' => '金額上限',
        'business_hours' => '営業時間',
        'business_period' => '営業期間',
        'closed_day' => '店休日',
        'zip_code' => '郵便番号',
        'address' => '住所',
        'phone_number' => '電話番号',
    ],
];
