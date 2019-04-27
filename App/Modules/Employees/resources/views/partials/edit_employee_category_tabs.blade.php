<ul class="nav nav-pills flex-md-column">

    @if(is_null($employee_category))

        <li class="nav-item">
            <a href="#" class="nav-link active">{{ trans('employees::employee_category.employee_category_details') }}</a>
        </li>

    @else

        <li class="nav-item">
            <a href="{{ route('employee_category.details.edit', $employee_category->id) }}"
               class="nav-link {{ active_class(if_route(['employee_category.details.edit'])) }}">
                {{ trans('employees::employee_category.employee_category_details') }}
            </a>
        </li>

    @endif

</ul>