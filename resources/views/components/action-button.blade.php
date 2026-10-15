<div class="dropdown">
    <button class="btn btn-sm btn-light-primary dropdown-toggle" type="button" id="dropdownMenuButton_{{ $id }}"
        data-bs-toggle="dropdown" aria-expanded="false">
        Aksi
    </button>
    <ul class="dropdown-menu p-3" aria-labelledby="dropdownMenuButton_{{ $id }}">
        @foreach ($actions as $action)
            @if (!empty($action['url']))
                @if (!empty($action['can']))
                    @can($action['can'])
                        <a class="dropdown-item bg-hover-light-primary text-hover-primary fw-semibold text-gray-600"
                            href="{{ $action['url'] }}">
                            <i class="ki-duotone {{ $action['icon'] }} fs-7 me-1">
                                @for ($i = 1; $i <= $action['icon_path']; $i++)
                                    <span class="path{{ $i }}"></span>
                                @endfor
                            </i>
                            {{ $action['label'] }}
                        </a>
                    @endcan
                @else
                    <a class="dropdown-item bg-hover-light-primary text-hover-primary fw-semibold text-gray-600"
                        href="{{ $action['url'] }}">
                        <i class="ki-duotone {{ $action['icon'] }} fs-7 me-1">
                            @for ($i = 1; $i <= $action['icon_path']; $i++)
                                <span class="path{{ $i }}"></span>
                            @endfor
                        </i>
                        {{ $action['label'] }}
                    </a>
                @endif
            @else
                @if (!empty($action['can']))
                    @can($action['can'])
                        <button onclick="{{ !empty($action['onclick']) ? $action['onclick'] : '' }}"
                            class="dropdown-item bg-hover-light-primary text-hover-primary fw-semibold text-gray-600"
                            type="button">
                            <i class="ki-duotone {{ $action['icon'] }} fs-7 me-1">
                                @for ($i = 1; $i <= $action['icon_path']; $i++)
                                    <span class="path{{ $i }}"></span>
                                @endfor
                            </i>
                            {{ $action['label'] }}
                        </button>
                    @endcan
                @else
                    <button onclick="{{ !empty($action['onclick']) ? $action['onclick'] : '' }}"
                        class="dropdown-item bg-hover-light-primary text-hover-primary fw-semibold text-gray-600"
                        type="button">
                        <i class="ki-duotone {{ $action['icon'] }} fs-7 me-1">
                            @for ($i = 1; $i <= $action['icon_path']; $i++)
                                <span class="path{{ $i }}"></span>
                            @endfor
                        </i>
                        {{ $action['label'] }}
                    </button>
                @endif
            @endif
        @endforeach
    </ul>
</div>
