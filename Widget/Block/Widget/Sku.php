<?php
/**
 * Created By : Rohan Hapani
 */
namespace Dev\Widget\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Sku extends Template implements BlockInterface
{
   protected $_template = "Dev_Widget::widget/widget.phtml";

   protected $_productRepository;
   protected $_productRepositoryInterface;
   protected $_product;

   public function __construct(
   \Magento\Backend\Block\Template\Context $context,
   \Magento\Catalog\Model\ProductRepository $productRepository,
   \Magento\Catalog\Api\ProductRepositoryInterface $productRepositoryInterface,
   \Magento\Catalog\Model\ProductFactory $productFactory,
   \Magento\Catalog\Model\Product $product,
   array $data = []
   )
   {
         $this->_productRepository = $productRepository;
         $this->_productRepositoryInterface = $productRepositoryInterface;
         $this->_product = $product;
         parent::__construct($context, $data);
   }

   public function productExistBySku($sku)
    {
        if ($this->getData('sku')) 
        {
            return true;
        }
    }

   public function getProductBySku($sku)
   {
      return $this->_productRepository->get($sku);
   }

   public function getAssetUrl($asset)
   {
    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    $assetRepository = $objectManager->get('Magento\Framework\View\Asset\Repository');
    return $assetRepository->createAsset($asset)->getUrl();
   }

}