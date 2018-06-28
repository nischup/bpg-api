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

<li>
    <li class="close-item">
        <a href="{{ route('user.page') }}"><i class="fa fa-cubes" aria-hidden="true"></i><span> user </span></a>
    </li>
</li>

<li class=" has-child-item {!! (in_array('infograph',$menu)) ? 'open-item' : 'close-item' !!}">
    <a>
        <i class="fa fa-sitemap" aria-hidden="true"></i>
        <span> Infographic List </span>
    </a>
    <ul class="nav child-nav level-1">
        <!--UI ELEMENTENTS-->
        <li class="close-item">
            <a href="{{ route('infograph.index') }}"><i class="fa fa-cubes" aria-hidden="true"></i><span> Infographic List </span></a>
        </li>
    </ul>
</li>

<li class=" has-child-item {!! (in_array('quiz_topic',$menu)) ? 'open-item' : 'close-item' !!}">
    <a>
        <i class="fa fa-sitemap" aria-hidden="true"></i>
        <span> Quiz Setup  </span>
    </a>
    <ul class="nav child-nav level-1">
        <!--UI ELEMENTENTS-->
        <li class="close-item">
            <a href="{{ route('quiz.index') }}"><i class="fa fa-cubes" aria-hidden="true"></i><span> Quiz Topic </span></a>
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

<li>
 <a href="http://localhost/quizard_admin/db_backup/?type=download"><i class="fa fa-download"></i> Database Dump <span class="fa fa-chevron-top"></span></a>
</li>

{{-- <li>
 <a href="{{ route('pages/{name}') }}"><i class="fa fa-download"></i> Pages <span class="fa fa-chevron-top"></span></a>
</li> --}}


