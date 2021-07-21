
<button type="button" class="button x-small" wire:click="showForm">
    {{ trans('parents.add_parent') }}
</button><br><br>

<div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>#</th>
            <th>{{ trans('parents.Email') }}</th>
            <th>{{ trans('parents.Name_Father') }}</th>
            <th>{{ trans('parents.National_ID_Father') }}</th>
            <th>{{ trans('parents.Phone_Father') }}</th>
            <th>{{ trans('parents.Job_Father') }}</th>
            <th>{{ trans('parents.Processes') }}</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0; ?>
        @foreach ($parents as $parent)
            <tr>
                <?php $i++; ?>
                <td>{{ $i }}</td>
                <td>{{ $parent->email }}</td>
                <td>{{ $parent->father_name }}</td>
                <td>{{ $parent->father_id }}</td>
                <td>{{ $parent->father_mobile }}</td>
                <td>{{ $parent->father_job }}</td>
                <td>
                    <button wire:click="edit({{ $parent->id }})" title="{{ trans('grades.edit') }}"
                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $parent->id }})" title="{{ trans('grades.delete') }}"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        @endforeach
    </table>
</div>
