<?php

/**
 * 分页类
 * Created by PhpStorm.
 * User: Turtle
 * Date: 2015/11/16
 * Time: 14:56
 */
class ctlPage
{
    private $_total;    //总记录数
    private $_curPage;  //当前页
    private $_pageSize; //每页数量
    private $_pageNum;  //总页数
    private $_bothNum;  //前后显示的页码数

    public function __construct($total, $curPage, $pageSize = 10, $bothNum = 3)
    {
        $this->_total = $total;
        $this->_pageSize = $pageSize;
        $this->_pageNum = ceil($this->_total / $this->_pageSize);
        $this->_curPage = $curPage;
        $this->_bothNum = $bothNum;
    }

    //首页
    private function _first()
    {
        $re = '';
        if ($this->_curPage > ($this->_bothNum + 1)) {
            $re .= '<li><a href="javascript:void(0);" value="1">首页</a></li>';
        }
        return $re;
    }

    //上一页
    private function _prev()
    {
        if ($this->_curPage == 1) {
            return '<li class="disabled"><a href="javascript:void(0);">上一页</a></li>';
        }
        return '<li><a href="javascript:void(0);" value="' . ($this->_curPage - 1) . '">上一页</a></li>';
    }

    //下一页
    private function _next()
    {
        if ($this->_curPage == $this->_pageNum) {
            return '<li class="disabled"><a href="javascript:void(0);">下一页</a></li>';
        }
        return '<li><a href="javascript:void(0);" value="' . ($this->_curPage + 1) . '">下一页</a></li>';
    }

    //末页
    private function _last()
    {
        $re = '';
        if (($this->_pageNum - $this->_curPage) > $this->_bothNum) {
            $re .= '<li><a href="javascript:void(0);" value="' . $this->_pageNum . '">末页</a></li>';
        }
        return $re;
    }

    //数字目录
    private function _pageList()
    {
        $list = '';
        for ($i = $this->_bothNum; $i >= 1; $i--) {
            $page = $this->_curPage - $i;
            if ($page < 1) continue;
            $list .= '<li><a href="javascript:void(0);" value="' . $page . '">' . $page . '</a></li>';
        }
        $list .= '<li class="active"><a href="javascript:void(0);" value="' . $this->_curPage . '">' . $this->_curPage . '</a></li>';
        for ($i = 1; $i <= $this->_bothNum; $i++) {
            $page = $this->_curPage + $i;
            if ($page > $this->_pageNum) break;
            $list .= '<li><a href="javascript:void(0);" value="' . $page . '">' . $page . '</a></li>';
        }
        return $list;
    }

    //返回分页信息
    public function showPage()
    {
        $result = '<div class="G-pagination"><ul class="pagination">';
        $result .= $this->_first();
        $result .= $this->_pageList();
        $result .= $this->_last();
        $result .= $this->_prev();
        $result .= $this->_next();
        $result .= '</ul><span class="total">共<b>' . $this->_pageNum . '</b>页</span></div>';
        return $result;
    }
}
