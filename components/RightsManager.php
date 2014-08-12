<?php

namespace de1phi\rights\components;

use yii\rbac\DbManager;
use yii\rbac\Item;
use yii\db\Query;

class RightsManager extends DbManager
{
    public $userModel = 'de1phi\user\models\User';

    public function getRoles() {
        $query = (new Query)
            ->from($this->itemTable)
            ->where(['type' => Item::TYPE_ROLE]);

        $roles = [];
        foreach ($query->all($this->db) as $row) {
            $roles[$row['name']] = $this->populateItem($row);
        }

        return $roles;
    }

    /**
     * @inheritdoc
     */
    public function getRole($name) {
        $row = (new Query)->from($this->itemTable)
            ->where(['name' => $name, 'type' => Item::TYPE_ROLE])
            ->one($this->db);

        if ($row === false) {
            return null;
        }

        if (!isset($row['data']) || ($data = @unserialize($row['data'])) === false) {
            $data = null;
        }

        return $this->populateItem($row);
    }

    /**
     * @inheritdoc
     */
    public function addRole($role) {
        $role->type = Item::TYPE_ROLE;
        
        $this->addItem($role);

        return true;
    }

    /**
     * @inheritdoc
     */
    public function updateRole($name, $role) {
        $role->type = Item::TYPE_ROLE;
        
        $this->updateItem($name, $role);

        return true;
    }

    /**
     * @inheritdoc
     */
    public function deleteRole($name) {
        $role = $this->getRole($name);
        $this->removeItem($role);

        return true;
    }

    /**
     * @inheritdoc
     */
    public function getParents($itemName) {
        $query = (new Query) 
            ->select(['parent'])
            ->from($this->itemChildTable)
            ->where(['child' => $itemName]);
        $parents = $query->all($this->db);
        
        return $parents;
    }

    /**
     * @inheritdoc
     */
    public function getChildrens($parent) {
        $query = (new Query)->from($this->itemChildTable)
            ->where(['parent' => $parent]);
        $childrens = $query->all($this->db);

        return $childrens;
    }

    /**
     * @inheritdoc
     */
    public function getPermissions() {
        $query = (new Query)
            ->from($this->itemTable)
            ->where(['type' => Item::TYPE_PERMISSION]);

        $permissions = [];
        foreach ($query->all($this->db) as $row) {
            $permissions[$row['name']] = $this->populateItem($row);
        }

        return $permissions;
    }

    /**
     * @inheritdoc
     */
    public function getPermission($name) {
        $row = (new Query)->from($this->itemTable)
            ->where(['name' => $name, 'type' => Item::TYPE_PERMISSION])
            ->one($this->db);

        if ($row === false) {
            return null;
        }

        if (!isset($row['data']) || ($data = @unserialize($row['data'])) === false) {
            $data = null;
        }

        return $this->populateItem($row);
    }

     /**
     * @inheritdoc
     */
    public function addPermission($permission) {
        $permission->type = Item::TYPE_PERMISSION;
        
        $this->addItem($permission);

        return true;
    }

    /**
     * @inheritdoc
     */
    public function updatePermission($name, $permission) {
        $permission->type = Item::TYPE_PERMISSION;
        
        $this->updateItem($name, $permission);

        return true;
    }

    /**
     * @inheritdoc
     */
    public function deletePermission($name) {
        $permission = $this->getPermission($name);
        $this->removeItem($permission);

        return true;
    }

    /**
     * @inheritdoc
     */
    public function getAuthItems() {
        $query = (new Query)
            ->from($this->itemTable);

        $items = [];
        foreach ($query->all($this->db) as $row) {
            $items[$row['name']] = $this->populateItem($row);
        }

        return $items;
    }


    public function getItem($name) {
        $row = (new Query)->from($this->itemTable)
            ->where(['name' => $name])
            ->one($this->db);

        if ($row === false) {
            return null;
        }

        if (!isset($row['data']) || ($data = @unserialize($row['data'])) === false) {
            $data = null;
        }

        return $this->populateItem($row);
    }
}
?>