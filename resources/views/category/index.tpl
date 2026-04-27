{extends file="layout.tpl"}
{block name="content"}
    <h1>{$category.name}</h1>
    <p>{$category.description}</p>
    <div class="sort">
        <a href="?id={$category.id}&sort=date&page=1">By date</a> |
        <a href="?id={$category.id}&sort=views&page=1">By views</a>
    </div>
    <div class="posts">
        {foreach $posts as $post}
            <div class="post-card">
                <img src="{$post.image}" alt="{$post.title}">
                <h3>{$post.title}</h3>
                <small>
                    {$post.created_at}
                </small>
                <p>{$post.description}</p>
                <small>{$post.views} views</small><br>
                <a href="/post?id={$post.id}">Read</a>
            </div>
        {/foreach}
    </div>
    <div class="pagination">
        {if $page > 1}
            <a href="?id={$category.id}&sort={$sort}&page={$page-1}">Prev</a>
        {/if}
        <span>{$page} / {$totalPages}</span>
        {if $page < $totalPages}
            <a href="?id={$category.id}&sort={$sort}&page={$page+1}">Next</a>
        {/if}
    </div>
{/block}