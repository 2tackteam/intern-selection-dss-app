@php use App\Models\Criteria; @endphp
<section>
    <div class="flex flex-col space-y-3">

        <x-datatable :id="'dtCriteriaValueMatrix'" :lengthChange="false" :searching="false"
                     :datatable="false">
            <x-slot:thead>
                <x-datatable.row isHeader>
                    <x-datatable.col class="text-red-500 dark:text-red-400"
                                     :value="__('internship-applicant-selection.table.headers.criteria_matrix')"/>
                    @foreach($data['criteria'] as $criterion)
                        <x-datatable.col :value="$criterion->name"/>
                    @endforeach
                    <x-datatable.col :value="__('internship-applicant-selection.table.headers.amount')"/>
                    <x-datatable.col class="text-blue-500 dark:text-blue-400"
                        :value="__('internship-applicant-selection.table.headers.priority')"/>
                </x-datatable.row>
            </x-slot:thead>
            <x-slot:tbody>
                @foreach(session('result')['normalizedMatrix'] as $i => $normalizedMatrix)
                    <x-datatable.row>
                        <x-datatable.col :value="$data['criteria'][$i]->name"/>
                        @foreach($data['criteria'] as $j => $criterion)
                            <x-datatable.col :value="$normalizedMatrix[$j]"/>
                        @endforeach
                        <x-datatable.col :value="array_sum($normalizedMatrix)"/>
                        <x-datatable.col class="text-blue-500 dark:text-blue-400"
                                         :value="session('result')['priorityVector'][$i]"/>
                    </x-datatable.row>
                @endforeach
            </x-slot:tbody>
        </x-datatable>


        @foreach(session('result')['subNormalizedMatrix'] as $i => $subNormalizedMatrix)
            @php($criterion = $data['criteria'][$i])
            @if($criterion instanceof Criteria)
                <x-datatable :id="'dtSubCriteriaValueMatrix'.$loop->iteration"
                             :lengthChange="false" :searching="false" :datatable="false">
                    <x-slot:thead>
                        <x-datatable.row isHeader>
                            <x-datatable.col class="text-red-500 dark:text-red-400"
                                             :value="__('internship-applicant-selection.table.headers.sub_criteria_matrix', ['value' => $criterion->name])"/>
                            @foreach($criterion->subCriterias as $subCriterion)
                                <x-datatable.col :value="$subCriterion->name"/>
                            @endforeach
                            <x-datatable.col :value="__('internship-applicant-selection.table.headers.amount')"/>
                            <x-datatable.col class="text-blue-500 dark:text-blue-400"
                                             :value="__('internship-applicant-selection.table.headers.priority')"/>
                        </x-datatable.row>
                    </x-slot:thead>
                    <x-slot:tbody>
                        @foreach($subNormalizedMatrix as $j => $subMatrix)
                            <x-datatable.row>
                                <x-datatable.col :value="$criterion->subCriterias[$j]->name"/>
                                @foreach($criterion->subCriterias as $k => $subCriterion)
                                    <x-datatable.col :value="round($subMatrix[$k], 3)"/>
                                @endforeach
                                <x-datatable.col :value="array_sum($subMatrix)"/>
                                <x-datatable.col class="text-blue-500 dark:text-blue-400"
                                                 :value="session('result')['subPriorityVector'][$i][$j]"/>
                            </x-datatable.row>
                        @endforeach
                    </x-slot:tbody>
                </x-datatable>
            @endif
        @endforeach
    </div>
</section>
