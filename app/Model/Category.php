<?php
App::uses('Sanitize', 'Utility', 'Model');
class Category extends Model {
	public function afterDelete() {
		$this->__deleteChildren($this->id);
	}
	
	private function __deleteChildren($parentId) {
	   $children = $this->findAllByParentId($parentId);
	   if (!empty($children)) {
			foreach ($children as $child) {
			   $this->delete($child['Category']['id']);
			}
		}
	}
}

