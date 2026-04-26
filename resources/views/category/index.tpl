<h1>{$category.name}</h1>
<p>{$category.description}</p>
<hr>
<div>
    <a href="?id={$category.id}&sort=date&page=1">By date</a> |
    <a href="?id={$category.id}&sort=views&page=1">By views</a>
</div>
<hr>
{foreach $posts as $post}
    <div>
        <h3>{$post.title}</h3>
        <p>{$post.description}</p>
        <small>👁 {$post.views} views</small><br>
        <a href="/post?id={$post.id}">
            Read
        </a>
    </div>
    <hr>
{/foreach}
<div>
    {if $page > 1}
        <a href="?id={$category.id}&sort={$sort}&page={$page-1}">
            Prev
        </a>
    {/if}
    <span>
        Page {$page} / {$totalPages}
    </span>
    {if $page < $totalPages}
        <a href="?id={$category.id}&sort={$sort}&page={$page+1}">
            Next
        </a>
    {/if}
</div>