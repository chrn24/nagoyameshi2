@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    <h2 class="text-center display-6 mb-4"><strong>レビュー内容確認</strong></h2>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('reviews.store') }}" method="POST" class="p-4 border rounded bg-light shadow-sm">
                @csrf
                <input type="hidden" name="shop_id" value="{{ $review['shop_id'] }}">
                <input type="hidden" name="rating" value="{{ $review['rating'] }}">
                <input type="hidden" name="comment" value="{{ $review['comment'] }}">
                 @if (!empty($review['review_id']))
                 <input type="hidden" name="review_id" value="{{ $review['review_id'] }}">
                 @endif

                <div class="mb-3">
                    <label class="form-label fw-bold">評価</label>
                    <p class="form-control-plaintext">{{ $review['rating'] }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">コメント</label>
                    <p class="form-control-plaintext">{{ $review['comment'] ?? '（なし）' }}</p>
                </div>

                <div class="d-flex justify-content-center gap-3 mt-4">
                 @if (!empty($isEdit))
                  <button type="submit" name="back" value="true" class="btn btn-secondary">修正する</button>
                  <button type="submit" name="submit" class="btn btn-primary">更新する</button>
                 @else
                  <button type="submit" name="back" value="true" class="btn btn-secondary">修正する</button>
                  <button type="submit" name="submit" class="btn btn-primary">投稿する</button>
                 @endif
                 
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
