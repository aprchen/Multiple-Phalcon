<?php
namespace Multiple\Backend\Auth;
use Phalcon\Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Acl\Adapter\Memory as AclList;

/**
 * 验证插件
 *
 * This is the security plugin which controls that users only have access to the modules they're assigned to
 */
class SecurityPlugin extends Plugin
{
	/**
     * 返回权限控制
	 * Returns an existing or new access control list
	 *
	 * @returns AclList
	 */
	public function getAcl()
	{
		if (!isset($this->persistent->acl)) {
            // 创建一个 ACL
			$acl = new AclList();
            // 默认行为是 DENY(拒绝) 访问
			$acl->setDefaultAction(Acl::DENY);

			// 注册用户身份
			$roles = [
				'users'  => new Role(
					'Users',
					'注册用户'
				),
                'guests' => new Role(
                    'Guests',
                    '测试'
                )
			];

			foreach ($roles as $role) {
				$acl->addRole($role);
			}

            // 私有区域资源 (控制器--(方法))

			$privateResources = array(
				'index'    => array('my'),

			);

			foreach ($privateResources as $resource => $actions) {
				$acl->addResource(new Resource($resource), $actions);
			}

            // 公共区域资源
			$publicResources = array(
				'index'      => array('index','hello','json'),
				'errors'     => array('show401', 'show404', 'show500'),
				'session'    => array('index', 'register', 'start', 'end'),
			);

			foreach ($publicResources as $resource => $actions) {
				$acl->addResource(new Resource($resource), $actions);
			}

            // 授权访问公共区域
			foreach ($roles as $role) {
				foreach ($publicResources as $resource => $actions) {
					foreach ($actions as $action){
						$acl->allow($role->getName(), $resource, $action);
					}
				}
			}

            // 授权 访问私有区域
			foreach ($privateResources as $resource => $actions) {
				foreach ($actions as $action){
					$acl->allow('Users', $resource, $action);
				}
			}

			//acl存储在会话中，APC在这里也很有用
			$this->persistent->acl = $acl;
		}

		return $this->persistent->acl;
	}

	/**
	 *
	 *
	 * @param Event $event
	 * @param Dispatcher $dispatcher
	 * @return bool
     * beforeDispatch
     * beforeExecuteRoute
	 */
	public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
	{

        // 检查session中是否存在"auth"变量来定义当前活动的角色
		$auth = $this->session->get('auth');
		if (!$auth){
			$role = 'Guests';
		} else {
			$role = 'Users';
		}

        // 从分发器获取活动的 controller/action
		$controller = $dispatcher->getControllerName();
		$action = $dispatcher->getActionName();
        // 获得ACL列表
		$acl = $this->getAcl();

		if (!$acl->isResource($controller)) {
			$dispatcher->forward([
				'controller' => 'errors',
				'action'     => 'show404'
			]);

			return false;
		}

        // 检验角色是否允许访问控制器 (resource)
		$allowed = $acl->isAllowed($role, $controller, $action);
		if (!$allowed) {
			$dispatcher->forward(array(
				'controller' => 'errors',
				'action'     => 'show401'
			));
            $this->session->destroy();
			return false;
		}
	}
}
