{extends file='parent:catalog/_partials/miniatures/product.tpl'}

{block name='product_miniature_item'}
    <article class="product-miniature js-product-miniature" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemscope itemtype="http://schema.org/Product">
        <div class="thumbnail-container">
            {block name='product_thumbnail'}
                {if $product.cover}
                    <a href="{$product.url}" class="thumbnail product-thumbnail">
                        <img src="{$product.cover.bySize.home_default.url}" alt="{if !empty($product.cover.legend)}{$product.cover.legend}{else}{$product.name|truncate:30:'...'}{/if}" data-full-size-image-url="{$product.cover.large.url}"/>
                    </a>
                {else}
                    <a href="{$product.url}" class="thumbnail product-thumbnail">
                        <img src="{$urls.no_picture_image.bySize.home_default.url}" />
                    </a>
                {/if}
            {/block}

            <div class="product-description">
                {block name='product_name'}
                    {if $page.page_name == 'index'}
                        <h3 class="h3 product-title" itemprop="name"><a href="{$product.url}">{$product.name|truncate:30:'...'}</a></h3>
                    {else}
                        <h2 class="h3 product-title" itemprop="name"><a href="{$product.url}"><strong>{$product.name|truncate:30:'...'|upper}</strong></a></h2>
                    {/if}
                {/block}

                {block name='product_description'}
                    <p class="product-title">{$product.description_short|strip_tags|truncate:55:'...'}</p>
                {/block}

                {block name='product_price_and_shipping'}
                    {if $product.show_price}
                        <div class="product-price-and-shipping">
                            {if $product.has_discount}
                                {hook h='displayProductPriceBlock' product=$product type="old_price"}
                                <span class="sr-only">{l s='Regular price' d='Shop.Theme.Catalog'}</span>
                                <span class="regular-price">{$product.regular_price}</span>
                                {if $product.discount_type === 'percentage'}
                                    <span class="discount-percentage discount-product">{$product.discount_percentage}</span>
                                {elseif $product.discount_type === 'amount'}
                                    <span class="discount-amount discount-product">{$product.discount_amount_to_display}</span>
                                {/if}
                            {/if}

                            {hook h='displayProductPriceBlock' product=$product type="before_price"}
                            <span class="sr-only">{l s='Price' d='Shop.Theme.Catalog'}</span>
                            <span itemprop="price" class="price">{Tools::displayPrice($product.price_tax_exc)}<small>HT</small> | {$product.price}</span>

                            {hook h='displayProductPriceBlock' product=$product type='unit_price'}
                            {hook h='displayProductPriceBlock' product=$product type='weight'}
                        </div>
                    {/if}
                {/block}

                {block name='product_reviews'}
                    {hook h='displayProductListReviews' product=$product}
                {/block}
            </div>

            <!-- @todo: use include file='catalog/_partials/product-flags.tpl'} -->
            {block name='product_flags'}
                <ul class="product-flags">
                    {foreach from=$product.flags item=flag}
                        <li class="product-flag {$flag.type}">{$flag.label}</li>
                    {/foreach}
                </ul>
            {/block}
        </div>
    </article>
{/block}
