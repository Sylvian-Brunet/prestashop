{extends file=$layout}

{block name='content'}
    <section id="main">
        {block name='page_content_container'}
            {foreach $categories as $category}
                <div class="row">
                    <div class="card card-block">
                        <a href="{$base_url}module/sylvian_blog/category?id_blog_category={$category.id_blog_category}">{$category.title}</a>
                    </div>
                </div>
            {/foreach}
            {if empty($categories)}
                <div class="row">
                    <div class="card card-block">
                        Il n'y as pas de catégorie(s) pour le moment !
                    </div>
                </div>
            {/if}
        {/block}
    </section>
{/block}