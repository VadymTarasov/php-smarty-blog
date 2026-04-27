{extends file="layout.tpl"}
{block name="content"}
    <h1>{$post.title}</h1>
    <img class="post-image" src="{$post.image}">
    <p><strong>{$post.description}</strong></p>
    <div>
        {$post.content}
    </div>
    <p>{$post.views} views</p>
    <h3>Related</h3>
    <ul>
        {foreach $relatedPosts as $rel}
            <li>
                <a href="/post?id={$rel.id}">{$rel.title}</a>
            </li>
        {/foreach}
    </ul>
{/block}