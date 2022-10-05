<?php

declare(strict_types=1);

namespace Modules\Ticket\Models\Panels\Actions;

use Modules\Xot\Models\Panels\Actions\XotBasePanelAction;

/**
 * Class CreateAction.
 */
class CreateAction extends XotBasePanelAction {
    public bool $onContainer = true;

    public string $icon = '<i class="fa fa-plus"></i>';

    /**
     * @return mixed
     */
    public function handle() {
        return $this->panel->view();
    }
}
