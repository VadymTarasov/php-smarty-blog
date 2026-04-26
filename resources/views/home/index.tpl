<h1>Blog Home</h1>
{foreach $data as $item}
    <div>
        <h2>{$item.category.name}</h2>
        <p>{$item.category.description}</p>
        <a href="/category?id={$item.category.id}&sort=date&page=1">
            View all posts
        </a>
        <h3>Latest posts</h3>
        <ul>
            {foreach $item.posts as $post}
                <li>
                    <strong>{$post.title}</strong><br>
                    {$post.description}<br>
                    <small>Views: {$post.views}</small>
                    <img src="{$post.image}"
                         alt="{$post.title}"
                         style="width: 100px; height: 100px; object-fit: cover;">
                </li>
            {/foreach}
        </ul>
        <hr>
    </div>
{/foreach}