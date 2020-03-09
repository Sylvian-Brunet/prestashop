{extends file=$layout}

{block name='content'}
    <section id="main">
        {block name='page_content_container'}
            <div class="row">
                <div class="card card-block">
                    Titre : {$post[0].title} <br>
                    Résumé : {$post[0].excerpt} <br>
                    Contenu : {$post[0].content nofilter} <br>
                </div>
            </div>
        {/block}
    </section>
{/block}