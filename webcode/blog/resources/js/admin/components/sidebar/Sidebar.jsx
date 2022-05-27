import React, { useState } from 'react'
import LineStyleIcon from '@material-ui/icons/LineStyle';
import PermIdentityIcon from '@material-ui/icons/PermIdentity';
import StorefrontIcon from '@material-ui/icons/Storefront';
import WhatsAppIcon from '@material-ui/icons/WhatsApp';
import { Link,useLocation } from 'react-router-dom';

export default function Sidebar() {

  const [activeMenu, setActiveMenu] = useState();
  const location = useLocation();
  
  return (
    <div className='sidebar'>
        <div className="sidebarWrapper">
          <div className='sidebarMenu'>
            <h3 className="sidebarTitle">Dashboard</h3>
            <ul className="sidebarList">
              <Link to="/admin" className='link'>
                <li className={`sidebarListItem ${location.pathname === '/admin' ? 'active' : ''}`} >
                  <LineStyleIcon className="sidebarIcon"/>
                  홈
                </li>
              </Link>
            </ul>
          </div>
          <div className='sidebarMenu'>
            <h3 className="sidebarTitle">Quick Menu</h3>
            <ul className="sidebarList">
              <Link to="/admin/users" className='link'>
                <li className={`sidebarListItem ${location.pathname.indexOf('user')!= '-1' ? 'active' : ''}`}>
                  <PermIdentityIcon className="sidebarIcon"/>
                  유저
                </li>
              </Link>
              <Link to="/admin/advertiseLists" className='link'>
                <li className={`sidebarListItem ${location.pathname.indexOf('advertise')!= '-1' ? 'active' : ''}`}>
                  <StorefrontIcon className="sidebarIcon"/>
                  광고 영역 설정
                </li>
              </Link>
              <Link to="/admin/inquiries" className='link'>
                <li className={`sidebarListItem ${location.pathname.indexOf('inquir')!= '-1' ? 'active' : ''}`}>
                  <WhatsAppIcon className="sidebarIcon"/>
                  1:1 문의
                </li>
              </Link>
            </ul>
          </div>
        </div>
    </div>
  )
}
