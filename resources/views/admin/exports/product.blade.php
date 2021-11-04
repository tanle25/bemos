<table>
    <thead>
    <tr>
        <th>id</th>
        <th>tiêu đề</th>
        <th>mô tả</th>
        <th>liên kết</th>
        <th>tình trạng</th>
        <th>giá</th>
        <th>còn hàng</th>
        <th>liên kết hình ảnh</th>
        <th>gtin</th>
        <th>mpn</th>
        <th>nhãn hiệu</th>
        <th>danh mục sản phẩm của Google</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            {{-- Đồ gỗ > Nội thất văn phòng --}}
            {{-- <th>{{  }}</th> --}}
            <td>{{ $product->sku }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->short_description}}</td>
            <td>{{url('detail/'.$product->slug)}}</td>
            <td>mới</td>
            <td>{{ ($product->promotion_price != null) ? $product->promotion_price : $product->price }} vnd</td>
            <td>còn hàng</td>
            <td>{{ $product->avatar }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td>Đồ gỗ > Nội thất văn phòng</td>
        </tr>
    @endforeach
    </tbody>
</table>
