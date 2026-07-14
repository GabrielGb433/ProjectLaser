<div class="flex min-h-0 justify-center">
    @if (filled($imageUrl))
        <img
            src="{{ $imageUrl }}"
            alt="{{ $alt }}"
            class="max-h-[75vh] w-auto max-w-full rounded-lg object-contain"
        >
    @else
        <p class="text-sm text-gray-500">Nenhuma imagem disponível.</p>
    @endif
</div>
