<?php


namespace Seek\QuansutongSDK;


class Order extends Api
{

    /**
     * 订单入库接口
     * http://doc.hnqst.cn/docs/qst_jkwd/qst_ddrkjk
     * @param array $order
     * @return mixed
     */
    public function createOrder(array $order)
    {
        return $this->request('ordersys/sellOrder/addorderQst', $order);
    }


    /**
     * 销售订单取消接口
     * @param string $orderNo 订单编号
     * @param string $cancelReason 订单取消原因
     * @return mixed
     */
    public function cancelOrder(string $orderNo, string $cancelReason)
    {
        $params = [
            'orderno' => $orderNo,
            'cancelReason' => $cancelReason
        ];
        return $this->request('ordersys/sellOrder/addorderQst', $params);
    }


    /**
     * 库存查询接口
     * @param string $goodsSku 商品条码
     * @param string $storageType 库存类型（SY:所有，ZP:正品；CC:残次）
     * @param string|null $goodsCode 自定义货号
     * @return mixed
     */
    public function queryStock(string $goodsSku, string $storageType, string $goodsCode = null)
    {
        $params = [
            'goodsSku' => $goodsSku,
            'storageType' => $storageType,
            'goodsCode' => $goodsCode
        ];

        return $this->request('wms/stock/queryStock', $params);
    }

    /**
     * 订单状态查询
     * @param string $orderNo
     * @return mixed
     */
    public function queryOrder(string $orderNo)
    {
        return $this->request('ordersys/querystep', ['orderno' => $orderNo]);
    }


    /**
     * 商品税率查询
     * @param string $goodsNo
     * @param string $price
     * @return mixed
     */
    public function queryGoodsTaxRate(string $goodsNo, string $price)
    {
        return $this->request('ordersys/querystep', ['goodsNo' => $goodsNo, 'price' => $price]);
    }



}