@props(['name', 'class' => 'w-5 h-5'])

@includeIf("components.icons.$name", ['class' => $class])
