PGDMP     0    8    
            x            SampleDB    12.2    12.2                0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            	           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            
           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    16393    SampleDB    DATABASE     �   CREATE DATABASE "SampleDB" WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'English_United States.1252' LC_CTYPE = 'English_United States.1252';
    DROP DATABASE "SampleDB";
                postgres    false            �            1259    16401    product    TABLE     �   CREATE TABLE public.product (
    id bigint NOT NULL,
    product_name text,
    product_price bigint NOT NULL,
    image text
);
    DROP TABLE public.product;
       public         heap    postgres    false            �            1259    16397    product_id_seq    SEQUENCE     w   CREATE SEQUENCE public.product_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.product_id_seq;
       public          postgres    false    204                       0    0    product_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.product_id_seq OWNED BY public.product.id;
          public          postgres    false    202            �            1259    16399    product_product_price_seq    SEQUENCE     �   CREATE SEQUENCE public.product_product_price_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.product_product_price_seq;
       public          postgres    false    204                       0    0    product_product_price_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.product_product_price_seq OWNED BY public.product.product_price;
          public          postgres    false    203            �
           2604    16404 
   product id    DEFAULT     h   ALTER TABLE ONLY public.product ALTER COLUMN id SET DEFAULT nextval('public.product_id_seq'::regclass);
 9   ALTER TABLE public.product ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    204    202    204            �
           2604    16405    product product_price    DEFAULT     ~   ALTER TABLE ONLY public.product ALTER COLUMN product_price SET DEFAULT nextval('public.product_product_price_seq'::regclass);
 D   ALTER TABLE public.product ALTER COLUMN product_price DROP DEFAULT;
       public          postgres    false    204    203    204                      0    16401    product 
   TABLE DATA           I   COPY public.product (id, product_name, product_price, image) FROM stdin;
    public          postgres    false    204   '                  0    0    product_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.product_id_seq', 22, true);
          public          postgres    false    202                       0    0    product_product_price_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.product_product_price_seq', 1, false);
          public          postgres    false    203            �
           2606    16410    product product_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.product DROP CONSTRAINT product_pkey;
       public            postgres    false    204               �  x���]O�H���_q��;���
�Gq刚MLif�������w4{�f�y�i�>}ޏ��q?c
!�se�GY�6�����\'i~�ka�aYI��UM���ئ61 &%�`Wh�K	:^��?7-��i!��[£��Z�hf]+���nMA/���yp���n������	q�ť_��Dg�3q�)"�^l�,J=�aq��B�%򤌓�A�����5̦�����Ѹ�/'����S����2m2/�������΁��NP������C�P,w��=�Z��'��cg�>m�40:[i�-�����\��7ڂ�`T;�?���o�ͰLj�kH���'�	Y��]b��~c�Oe����~s{�D0��c_F��a�?�����o*t�v���7�����<�A鍉�P���{n�|0��@��)yϕ؃��X~�s�����8�~њ���W=�E��ՇYX�� �J�U�R����,Վ�E4����
����S�����o���Qo�CN�[�P'E��U5�"�mn�#^/����� {#�!�G�m��
������eE�<(ޭ��m��C�q�������J���M�4���G�I���)�c>@�)Ĕ'C S��dj�z�A�ۆ.����^��xo��&C=N}5�)����\�̊�5����H�H$�J�s�G�"�0"{R���mw6�����>]�6�Ig�-�Sc�4@�D]ڴN�^��U�;��]�K�.���c~�f�!�Y��˳�I�s@���C���8�������?��4�y�M�M6�|oS�k/���Dpz(�)��7��:Yo��{�{L�1�*ο[~���
��@pL�s��kވi�x���������u���s���Q�     