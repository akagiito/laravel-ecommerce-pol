@inject ('wishListHelper', 'Webkul\Customer\Helpers\Wishlist')

{!! view_render_event('bagisto.shop.products.wishlist.before') !!}
    @auth('customer')
        @php
            $isWished = $wishListHelper->getWishlistProduct($product);
        @endphp

        <a
            class="unset wishlist-icon {{ $addWishlistClass ?? '' }}"
            @if (! $isWished)
                href="{{ route('customer.wishlist.add', $product->product_id) }}"
            @elseif (isset($itemId) && $itemId)
                href="{{ route('customer.wishlist.remove', $itemId) }}"
            @endif
            >

            <wishlist-component active="{{ !$isWished }}"></wishlist-component>
        </a>
    @endauth

    @guest('customer')
        <a
            href="{{ route('customer.session.index') }}"
            class="unset wishlist-icon {{ $addWishlistClass ?? '' }}">
            <wishlist-component active="false"></wishlist-component>
        </a>
    @endauth
{!! view_render_event('bagisto.shop.products.wishlist.after') !!}