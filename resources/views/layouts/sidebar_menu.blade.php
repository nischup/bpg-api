<!--Dashboard-->
<li {!! (in_array('dashboard',$menu)) ? 'class="active-item"' : '' !!}><a href="{{ route('dashboard') }}"><i class="fa fa-home" aria-hidden="true"></i><span>Dashboard</span></a></li>

<li class=" has-child-item {!! (in_array('user',$menu)) ? 'open-item' : 'close-item' !!}">
    <li class="close-item">
        <a href="{{ route('user.page') }}"><i class="fa fa-cubes" aria-hidden="true"></i><span> user </span></a>
    </li>
</li>

<li class=" has-child-item {!! (in_array('article',$menu)) ? 'open-item' : 'close-item' !!}">
    <a>
        <i class="fa fa-sitemap" aria-hidden="true"></i>
        <span> News  </span>
    </a>
    <ul class="nav child-nav level-1">
        <!--UI ELEMENTENTS-->
        <li class="close-item">
            <a href="{{ route('news.index') }}"><i class="fa fa-cubes" aria-hidden="true"></i><span> News List </span></a>
        </li>
    </ul>
</li>

<li class=" has-child-item {!! (in_array('category',$menu)) ? 'open-item' : 'close-item' !!}">
    <a>
        <i class="fa fa-sitemap" aria-hidden="true"></i>
        <span> Education </span>
    </a>
    <ul class="nav child-nav level-1">
        <li class="close-item">
            <a href="{{ route('category.index') }}"><i class="fa fa-cubes" aria-hidden="true"></i><span> Category List </span></a>
        </li>
    </ul>    
    <ul class="nav child-nav level-1">
        <li class="close-item">
            <a href="{{ route('category-title.index') }}"><i class="fa fa-cubes" aria-hidden="true"></i><span> Category Title </span></a>
        </li>
    </ul>
</li>

<li class=" has-child-item {!! (in_array('pips',$menu)) ? 'open-item' : 'close-item' !!}">
    <a>
        <i class="fa fa-sitemap" aria-hidden="true"></i>
        <span> Pips </span>
    </a>
    <ul class="nav child-nav level-1">
        <li class="close-item">
            <a href="{{ route('pips.index') }}"><i class="fa fa-cubes" aria-hidden="true"></i><span> Pips List </span></a>
        </li>
    </ul>    
    <ul class="nav child-nav level-1">
        <li class="close-item">
            <a href="{{ route('pips_detail.index') }}"><i class="fa fa-cubes" aria-hidden="true"></i><span> Pips Detail </span></a>
        </li>
    </ul>
</li>

<li class=" has-child-item {!! (in_array('quiz_topic',$menu)) ? 'open-item' : 'close-item' !!}">
    <a>
        <i class="fa fa-sitemap" aria-hidden="true"></i>
        <span> Signal  </span>
    </a>
    <ul class="nav child-nav level-1">
        <li class="close-item">
            <a href="{{ route('signal.index') }}"><i class="fa fa-cubes" aria-hidden="true"></i><span> Signal List </span></a>
        </li>
    </ul>
</li>

<li class=" has-child-item {!! (in_array('quiz_topic',$menu)) ? 'open-item' : 'close-item' !!}">
    <a>
        <i class="fa fa-sitemap" aria-hidden="true"></i>
        <span> Message  </span>
    </a>
    <ul class="nav child-nav level-1">
        <li class="close-item">
            <a href="{{ route('message.index') }}"><i class="fa fa-cubes" aria-hidden="true"></i><span> Message List </span></a>
        </li>
    </ul>
</li>

{{-- <li>
 <a href="http://localhost/quizard_admin/db_backup/?type=download"><i class="fa fa-download"></i> Database Dump <span class="fa fa-chevron-top"></span></a>
</li> --}}

{{-- <li>
 <a href="{{ route('pages/{name}') }}"><i class="fa fa-download"></i> Pages <span class="fa fa-chevron-top"></span></a>
</li> --}}


