<table class="table">
    <thead>
        <tr>
            <th scope="col">Тема</th>
            <th scope="col">Тип</th>
            <th scope="col" class="text-center">Кол-во часов</th>
            <th scope="col" class="text-center">Дата</th>
            <th scope="col" class="text-end">Действия</th>
        </tr>
    </thead>
        <tbody>
        @forelse($discipline->lessons as $lesson)
            <tr>
                <td>{{ Str::limit($lesson->topic, 15) }}</td>
                <td>{{ $lesson->type }}</td>
                <td class="text-center">{{ $lesson->number_of_hours }}</td>
                <td class="text-center">{{ $lesson->date }}</td>
                <td class="text-end">
                    <a class="btn btn-sm btn-secondary"
                    href="{{ route('teacher.lessons.show', [$discipline, $lesson]) }}">Просмотреть</a>
                    <a class="btn btn-sm btn-primary"
                    href="{{ route('teacher.lessons.edit', [$discipline, $lesson]) }}">Редактировать</a>&nbsp;
                    <form action="{{ route('teacher.lessons.destroy', [$discipline, $lesson]) }}" method="post" class="float-end">
                    @csrf
                    @method('delete')
                    <button class="btn btn-sm btn-danger" type="submit">Удалить</a>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">
                    <h3 class="text-center">Текущие занятия отсутствуют</h3>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>