<li class="pl-4">
    <a href="<?php echo e($item->getPath()); ?>"
        class="<?php echo e('lvl' . $level); ?> <?php echo e($page->isItemActive($item) ? 'active font-semibold text-blue-500' : ''); ?> nav-menu__item hover:text-blue-500"
        >
        <?php echo e($item->title); ?>

    </a>
    <?php echo $__env->make('_nav.menu-tree', ['items' => $item->children($docs), 'level' => ++$level], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</li>
<?php /**PATH /var/www/html/_bases/base_pfed/laravel/Modules/Ticket/docs/source/_nav/menu-item-tree.blade.php ENDPATH**/ ?>