<div class="administr-listview-filters">
    {!! $builder->render() !!}

    {!! $filterBtn->render() !!}
    <a href="{{ $clearBtn['url'] }}">
        {{ $clearBtn['label'] }}
    </a>
</div>