<h1>{$post.title}</h1>
<img src="{$post.image}" width="400">
<p><strong>{$post.description}</strong></p>
<div>
    {$post.content}
</div>
<p>Views: {$post.views}</p>
<hr>
<h3>Related articles</h3>
<ul>
    {foreach $relatedPosts as $rel}
        <li>
            <a href="/post?id={$rel.id}">
                {$rel.title}
            </a>
            <small>({$rel.views} views)</small>
        </li>
    {/foreach}
</ul>