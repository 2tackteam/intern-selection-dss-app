@php use App\Models\Criteria;use App\Models\SubCriteria; @endphp
<section>
    <div class="flex flex-col space-y-3">

        <x-datatable :id="'dtCriteriaWeightMatrix'" :lengthChange="false" :searching="false"
                     :datatable="false">
            <x-slot:thead>
                <x-datatable.row isHeader>
                    <x-datatable.col class="text-red-500 dark:text-red-400"
                                     :value="__('internship-applicant-selection.table.headers.criteria_matrix')"/>
                    <x-datatable.col :value="__('internship-applicant-selection.table.headers.weight')"/>
                </x-datatable.row>
            </x-slot:thead>
            <x-slot:tbody>
                @foreach($data['criteria'] as $criterion)
                    @if($criterion instanceof Criteria)
                        <x-datatable.row>
                            <x-datatable.col :value="$criterion->name"/>
                            <x-datatable.col :value="round($criterion->weight)"/>
                        </x-datatable.row>
                    @endif
                @endforeach
            </x-slot:tbody>
        </x-datatable>

        @foreach($data['criteria'] as $criterion)
            @if($criterion instanceof Criteria)
                <x-datatable :id="'dtSubCriteriaWeightMatrix'.$loop->iteration"
                             :lengthChange="false" :searching="false" :datatable="false">
                    <x-slot:thead>
                        <x-datatable.row isHeader>
                            <x-datatable.col class="text-red-500 dark:text-red-400"
                                             :value="__('internship-applicant-selection.table.headers.sub_criteria_matrix', ['value' => $criterion->name])"/>
                            <x-datatable.col :value="__('internship-applicant-selection.table.headers.weight')"/>
                        </x-datatable.row>
                    </x-slot:thead>
                    <x-slot:tbody>
                        @foreach($criterion->subCriterias as $subCriterion)
                            @if($subCriterion instanceof SubCriteria)
                                <x-datatable.row>
                                    <x-datatable.col :value="$subCriterion->name"/>
                                    <x-datatable.col :value="round($subCriterion->weight)"/>
                                </x-datatable.row>
                            @endif
                        @endforeach
                    </x-slot:tbody>
                </x-datatable>
            @endif
        @endforeach
    </div>
</section>
