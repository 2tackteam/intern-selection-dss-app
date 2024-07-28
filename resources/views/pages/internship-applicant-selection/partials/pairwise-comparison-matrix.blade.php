@php use App\Models\Criteria;use App\Models\SubCriteria; @endphp
<section>
    <div class="flex flex-col space-y-3">

        <x-datatable :id="'dtCriteriaWeightMatrix'" :lengthChange="false" :searching="false"
                     :datatable="false">
            <x-slot:thead>
                <x-datatable.row isHeader>
                    <x-datatable.col class="text-red-500 dark:text-red-400"
                                     :value="__('internship-applicant-selection.table.headers.criteria_matrix')"/>
                    @foreach($data['criteria'] as $criterion)
                        <x-datatable.col :value="$criterion->name"/>
                    @endforeach
                </x-datatable.row>
            </x-slot:thead>
            <x-slot:tbody>
                @foreach(session('result')['comparisonMatrix'] as $i => $comparisonMatrix)
                    <x-datatable.row>
                        <x-datatable.col :value="$data['criteria'][$i]->name"/>
                        @foreach($data['criteria'] as $j => $criterion)
                            <x-datatable.col :value="$comparisonMatrix[$j]"/>
                        @endforeach
                    </x-datatable.row>
                @endforeach
            </x-slot:tbody>
        </x-datatable>

        @foreach(session('result')['subComparisonMatrix'] as $i => $subComparisonMatrix)
            @php($criterion = $data['criteria'][$i])
            @if($criterion instanceof Criteria)
                <x-datatable :id="'dtSubCriteriaWeightMatrix'.$loop->iteration"
                             :lengthChange="false" :searching="false" :datatable="false">
                    <x-slot:thead>
                        <x-datatable.row isHeader>
                            <x-datatable.col class="text-red-500 dark:text-red-400"
                                             :value="__('internship-applicant-selection.table.headers.sub_criteria_matrix', ['value' => $criterion->name])"/>
                            @foreach($criterion->subCriterias as $subCriterion)
                                <x-datatable.col :value="$subCriterion->name"/>
                            @endforeach
                        </x-datatable.row>
                    </x-slot:thead>
                    <x-slot:tbody>
                        @foreach($subComparisonMatrix as $j => $subMatrix)
                            <x-datatable.row>
                                <x-datatable.col :value="$criterion->subCriterias[$j]->name"/>
                                @foreach($criterion->subCriterias as $k => $subCriterion)
                                    <x-datatable.col :value="round($subMatrix[$k], 3)"/>
                                @endforeach
                            </x-datatable.row>
                        @endforeach
                    </x-slot:tbody>
                </x-datatable>
            @endif
        @endforeach
    </div>
</section>
