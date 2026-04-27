{extends file="layout.tpl"}
{block name="content"}
    <h1>Blog Home</h1>
    {foreach $data as $item}
        <div class="category">
            <div class="category-header">
                <h2>{$item.category.name}</h2>
                <a href="/category?id={$item.category.id}&sort=date&page=1">
                    View all
                </a>
            </div>
            <div class="posts">
                {foreach $item.posts as $post}
                    <div class="post-card">
                        <img src="{$post.image}" alt="{$post.title}" width="50px">
                        <h4>{$post.title}</h4>
                        <p>{$post.description}</p>
                        <small>{$post.views} views</small>
                    </div>
                {/foreach}
            </div>
        </div>
    {/foreach}
{/block}