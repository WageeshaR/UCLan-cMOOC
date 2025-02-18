<ul class="nav nav-tabs mb-4">
    <li class="nav-item">
        <a class="nav-link py-1 {{ request()->is('instructor-course-info*') ? 'active' : '' }}" href="@if($course->id) {{ route('instructor.course.info.edit', $course->id) }} @else {{ route('instructor.course.info') }} @endif">Course Info</a>
    </li>
    <li class="nav-item">
        <a class="nav-link py-1 {{ request()->is('instructor-course-image*') ? 'active' : '' }} @if(!$course->id) {{ 'course-id-empty' }} @endif" href="@if($course->id) {{ route('instructor.course.image.edit', $course->id) }} @else {{ 'javascript:void();' }} @endif">Course Image</a>
    </li>
    <li class="nav-item">
        <a class="nav-link py-1 {{ request()->is('instructor-course-video*') ? 'active' : '' }} @if(!$course->id) {{ 'course-id-empty' }} @endif" href="@if($course->id) {{ route('instructor.course.video.edit', $course->id) }} @else {{ 'javascript:void();' }} @endif">Promo Video</a>
    </li>
    <li class="nav-item">
        <a class="nav-link py-1 {{ request()->is('instructor-course-curriculum*') ? 'active' : '' }} @if(!$course->id) {{ 'course-id-empty' }} @endif" href="@if($course->id) {{ route('instructor.course.curriculum.edit', $course->id) }} @else {{ 'javascript:void();' }} @endif">Course Agenda</a>
    </li>
    <li class="nav-item">
        <a class="nav-link py-1 {{ request()->is('instructor-course-resources*') ? 'active' : '' }} @if(!$course->id) {{ 'course-id-empty' }} @endif" href="@if($course->id) {{ route('instructor.course.resources', $course->id) }} @else {{ 'javascript:void();' }} @endif">Course Resources</a>
    </li>
    <li class="nav-item">
        <a class="nav-link py-1 {{ request()->is('instructor-course-sm-content*') ? 'active' : '' }} @if(!$course->id) {{ 'course-id-empty' }} @endif" href="@if($course->id) {{ route('instructor.course.smContent.backend', $course->id) }} @else {{ 'javascript:void();' }} @endif">Social Media Content</a>
    </li>
</ul>