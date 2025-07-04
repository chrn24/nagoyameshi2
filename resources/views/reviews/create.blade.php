@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    <h2 class="text-center display-6 mb-4"><strong>レビュー投稿</strong></h2>
    

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('reviews.confirm') }}" method="POST" class="p-4 border rounded bg-light">
                @csrf
                <input type="hidden" name="shop_id" value="{{ $shop->id }}">

                <div class="mb-3">
                    <label for="rating" class="form-label">評価（1〜5）</label>
                    <select name="rating" id="rating" class="form-select" required>
                        <option value="">選択してください</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="mb-3">
                    <label for="comment" class="form-label">コメント</label>
                    <textarea name="comment" id="comment" class="form-control" rows="4" placeholder="お店の感想など">{{ old('comment') }}</textarea>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary w-50">確認画面へ</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
