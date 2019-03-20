/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     19/03/2019 08:42:53                          */
/*==============================================================*/


/*==============================================================*/
/* Table: KOMENTAR                                              */
/*==============================================================*/
create table KOMENTAR
(
   ID_KOMENTAR          int not null  comment '',
   ID_TIKET             varchar(6)  comment '',
   ISI_KOMENTAR         text  comment '',
   TGL_KOMENTAR         datetime  comment '',
   ID                   varchar(4)  comment '',
   PARENT_ID            int  comment '',
   primary key (ID_KOMENTAR)
);

/*==============================================================*/
/* Table: MANAGER                                               */
/*==============================================================*/
create table MANAGER
(
   ID_MANAGER           varchar(4) not null  comment '',
   USERNAME_MANAGER     varchar(10)  comment '',
   PASSWORD_MANAGER     varchar(20)  comment '',
   primary key (ID_MANAGER)
);

/*==============================================================*/
/* Table: PROGRAMER                                             */
/*==============================================================*/
create table PROGRAMER
(
   ID_PROGRAMER         varchar(4) not null  comment '',
   USERNAME_PROGRAMER   varchar(20)  comment '',
   PASSWORD_PROGRAMER   varchar(20)  comment '',
   DIVISI_PROGRAMER     varchar(20)  comment '',
   BIDANG_PROGRAMER     varchar(40)  comment '',
   primary key (ID_PROGRAMER)
);

/*==============================================================*/
/* Table: PROYEK                                                */
/*==============================================================*/
create table PROYEK
(
   ID_PROYEK            varchar(6) not null  comment '',
   ID_MANAGER           varchar(4)  comment '',
   ID_PROGRAMER         varchar(4)  comment '',
   NAMA_PROYEK          varchar(30)  comment '',
   INSTANSI_PROYEK      varchar(30)  comment '',
   DESKRIPSI_PROYEK     text  comment '',
   PLANFORM_PROYEK      varchar(10)  comment '',
   DEADLINE_PROYEK      date  comment '',
   STATUS_PROYEK        varchar(8)  comment '',
   primary key (ID_PROYEK)
);

/*==============================================================*/
/* Table: TIKET                                                 */
/*==============================================================*/
create table TIKET
(
   ID_TIKET             varchar(6) not null  comment '',
   ID_PROYEK            varchar(6)  comment '',
   ID_PROGRAMER         varchar(4)  comment '',
   AKTIFITAS_TIKET      text  comment '',
   PROGRESS_TIKET       varchar(5)  comment '',
   TIMELINE_TIKET       datetime  comment '',
   STATUS_TIKET         varchar(6)  comment '',
   primary key (ID_TIKET)
);

alter table KOMENTAR add constraint FK_KOMENTAR_DIKOMENTA_TIKET foreign key (ID_TIKET)
      references TIKET (ID_TIKET) on delete restrict on update restrict;

alter table PROYEK add constraint FK_PROYEK_MENAMBAHK_MANAGER foreign key (ID_MANAGER)
      references MANAGER (ID_MANAGER) on delete restrict on update restrict;

alter table PROYEK add constraint FK_PROYEK_MENGERJAK_PROGRAME foreign key (ID_PROGRAMER)
      references PROGRAMER (ID_PROGRAMER) on delete restrict on update restrict;

alter table TIKET add constraint FK_TIKET_MEMILIKI_PROGRAME foreign key (ID_PROGRAMER)
      references PROGRAMER (ID_PROGRAMER) on delete restrict on update restrict;

alter table TIKET add constraint FK_TIKET_MENJADI_PROYEK foreign key (ID_PROYEK)
      references PROYEK (ID_PROYEK) on delete restrict on update restrict;

