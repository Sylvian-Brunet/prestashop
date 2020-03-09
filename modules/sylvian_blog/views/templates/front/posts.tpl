{extends file=$layout}

{block name='content'}
    <section id="main" class="card card-block">
        {block name='page_content_container'}
            <h3>{$category[0].title}</h3>
            {foreach $posts as $post}
                <div class="row">
                    <a href="{$base_url}module/sylvian_blog/post?id_blog_post={$post.id_blog_post}">{$post.title}</a>
                </div>
            {/foreach}
            {if empty($posts)}
                <div class="row">
                    <div class="card card-block">
                        Il n'y as pas de post(s) pour cette catégorie
                    </div>
                </div>
            {/if}
        {/block}
    </section>
{/block}