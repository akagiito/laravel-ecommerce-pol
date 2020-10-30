@php
    $count = core()->getConfigData('catalog.products.homepage.no_of_featured_product_homepage');
    $count = $count ? $count : 10;
    $direction = core()->getCurrentLocale()->direction == 'rtl' ? 'rtl' : 'ltr';
@endphp

<featured-products></featured-products>

@push('scripts')
    <script type="text/x-template" id="featured-products-template">
        <div class="container-fluid featured-products">
            <shimmer-component v-if="isLoading"></shimmer-component>

            <template v-else-if="featuredProducts.length > 0">
                <card-list-header heading="{{ __('shop::app.home.featured-products') }}">
                </card-list-header>

                <div class="carousel-products vc-full-screen {{ $direction }}">
                    <carousel-component
                        slides-per-page="6"
                        navigation-enabled="hide"
                        pagination-enabled="hide"
                        id="fearured-products-carousel"
                        locale-direction="{{ $direction }}"
                        :autoplay="false"
                        :slides-count="featuredProducts.length">

                        <slide
                            :key="index"
                            :slot="`slide-${index}`"
                            v-for="(product, index) in featuredProducts">
                            <product-card
                                :list="list"
                                :product="product">
                            </product-card>
                        </slide>
                    </carousel-component>
                </div>

                <div class="carousel-products vc-small-screen {{ $direction }}">
                    <carousel-component
                        slides-per-page="2"
                        navigation-enabled="hide"
                        pagination-enabled="hide"
                        id="fearured-products-carousel"
                        locale-direction="{{ $direction }}"
                        :slides-count="featuredProducts.length">

                        <slide
                            :key="index"
                            :slot="`slide-${index}`"
                            v-for="(product, index) in featuredProducts">
                            <product-card
                                :list="list"
                                :product="product">
                            </product-card>
                        </slide>
                    </carousel-component>
                </div>
            </template>

        </div>
    </script>

    <script type="text/javascript">
        (() => {
            Vue.component('featured-products', {
                'template': '#featured-products-template',
                data: function () {
                    return {
                        'list': false,
                        'isLoading': true,
                        'featuredProducts': [],
                        'isMobileView': this.$root.isMobile(),
                    }
                },

                mounted: function () {
                    this.getFeaturedProducts();
                },

                methods: {
                    'getFeaturedProducts': function () {
                        this.$http.get(`${this.baseUrl}/category-details?category-slug=featured-products&count={{ $count }}`)
                        .then(response => {
                            var count = '{{$count}}';
                            if (response.data.status && count != 0 )
                            {
                                this.featuredProducts = response.data.products;
                            }else{
                                this.featuredProducts = 0;   
                            }

                            this.isLoading = false;
                        })
                        .catch(error => {
                            this.isLoading = false;
                            console.log(this.__('error.something_went_wrong'));
                        })
                    }
                }
            })
        })()
    </script>
@endpush
