@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    <h2 class="text-center display-6 mb-4"><strong>レビュー編集内容確認</strong></h2>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('reviews.update') }}" method="POST" class="p-4 border rounded bg-light shadow-sm">
                @csrf
                <input type="hidden" name="review_id" value="{{ $input['review_id'] }}">
                <input type="hidden" name="rating" value="{{ $input['rating'] }}">
                <input type="hidden" name="comment" value="{{ $input['comment'] }}">

                <div class="mb-3">
                    <label class="form-label fw-bold">評価</label>
                    <p class="form-control-plaintext">{{ $input['rating'] }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">コメント</label>
                    <p class="form-control-plaintext">{{ $input['comment'] ?? '（なし）' }}</p>
                </div>

                <div class="d-flex justify-content-center gap-3 mt-4">
                    <button type="submit" name="submit" class="btn btn-primary">更新する</button>
                    <button type="submit" name="back" value="true" class="btn btn-secondary">修正する</button>
                    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
