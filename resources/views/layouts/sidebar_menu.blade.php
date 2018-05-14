<!--Dashboard-->
<li {!! (in_array('dashboard',$menu)) ? 'class="active-item"' : '' !!}><a href="{{ route('dashboard') }}"><i class="fa fa-home" aria-hidden="true"></i><span>Dashboard</span></a></li>

<li class=" has-child-item {!! (in_array('article',$menu)) ? 'open-item' : 'close-item' !!}">
    <a>
        <i class="fa fa-sitemap" aria-hidden="true"></i>
        <span> Articles  </span>
    </a>
    <ul class="nav child-nav level-1">
        <!--UI ELEMENTENTS-->
        <li class="close-item">
            <a href="{{ route('articles.index') }}"><i class="fa fa-cubes" aria-hidden="true"></i><span> Articles List </span></a>
        </li>
    </ul>
</li>

<li class=" has-child-item {!! (in_array('infograph',$menu)) ? 'open-item' : 'close-item' !!}">
    <a>
        <i class="fa fa-sitemap" aria-hidden="true"></i>
        <span> Infographic  </span>
    </a>
    <ul class="nav child-nav level-1">
        <!--UI ELEMENTENTS-->
        <li class="close-item">
            <a href="{{ route('infograph.index') }}"><i class="fa fa-cubes" aria-hidden="true"></i><span> Infographic List </span></a>
        </li>
    </ul>
</li>

<li class=" has-child-item {!! (in_array('question',$menu)) ? 'open-item' : 'close-item' !!}">
    <a>
        <i class="fa fa-sitemap" aria-hidden="true"></i>
        <span> Question  </span>
    </a>
    <ul class="nav child-nav level-1">
        <!--UI ELEMENTENTS-->
        <li class="close-item">
            <a href="{{ route('question.index') }}"><i class="fa fa-cubes" aria-hidden="true"></i><span> Question List </span></a>
        </li>
    </ul>
</li>


