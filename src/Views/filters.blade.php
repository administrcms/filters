<div class="administr-filters">
    {!! $builder->render() !!}

    {!! $filterBtn->render() !!}
    <a href="{{ $clearBtn['url'] }}">
        {{ $clearBtn['label'] }}
    </a>
</div>