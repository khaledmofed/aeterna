<?php

namespace Database\Seeders;

use App\Models\ArchitectureLayer;
use App\Models\ExplorerPage;
use App\Models\FooterLink;
use App\Models\HeroSection;
use App\Models\NavItem;
use App\Models\RoadmapStage;
use App\Models\Solution;
use App\Models\Tokenomic;
use App\Models\UseCase;
use Illuminate\Database\Seeder;

class TranslationsSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedHero();
        $this->seedSolutions();
        $this->seedArchitecture();
        $this->seedTokenomics();
        $this->seedRoadmap();
        $this->seedUseCases();
        $this->seedNavItems();
        $this->seedFooterLinks();
        $this->seedExplorerPages();
    }

    // ─────────────────────────────────────────────
    private function seedHero(): void
    {
        $hero = HeroSection::first();
        if (!$hero) return;

        $hero->setTranslations('badge_text', [
            'en'    => 'AI Native Layer 1 - Now Live',
            'ja'    => 'AIネイティブ Layer 1 - 稼働中',
            'ko'    => 'AI 네이티브 Layer 1 - 현재 운영 중',
            'es'    => 'Capa 1 Nativa de IA - En Producción',
            'zh-TW' => 'AI 原生 Layer 1 - 現已上線',
            'vi'    => 'Tầng 1 Gốc AI - Đang Hoạt Động',
        ]);
        $hero->setTranslations('headline', [
            'en'    => 'The Future is Chainless.',
            'ja'    => '未来はチェーンレスだ。',
            'ko'    => '미래는 체인이 없다.',
            'es'    => 'El Futuro es Sin Cadenas.',
            'zh-TW' => '未來是無鏈的。',
            'vi'    => 'Tương Lai Không Có Chuỗi.',
        ]);
        $hero->setTranslations('subheadline', [
            'en'    => 'Building the infrastructure layer for a chainless, autonomous AI economy.',
            'ja'    => 'チェーンレスで自律的なAIエコノミーのためのインフラストラクチャ層を構築中。',
            'ko'    => '체인리스 자율 AI 경제를 위한 인프라 레이어를 구축합니다.',
            'es'    => 'Construyendo la capa de infraestructura para una economía de IA autónoma y sin cadenas.',
            'zh-TW' => '為無鏈、自主的 AI 經濟構建基礎設施層。',
            'vi'    => 'Xây dựng lớp cơ sở hạ tầng cho nền kinh tế AI tự trị, không chuỗi.',
        ]);
        $hero->setTranslations('cta_primary_text', [
            'en'    => 'Start Building',
            'ja'    => '構築を始める',
            'ko'    => '개발 시작하기',
            'es'    => 'Comenzar a Construir',
            'zh-TW' => '開始構建',
            'vi'    => 'Bắt Đầu Xây Dựng',
        ]);
        $hero->setTranslations('cta_secondary_text', [
            'en'    => 'Download Whitepaper',
            'ja'    => 'ホワイトペーパーをダウンロード',
            'ko'    => '백서 다운로드',
            'es'    => 'Descargar Whitepaper',
            'zh-TW' => '下載白皮書',
            'vi'    => 'Tải Whitepaper',
        ]);
        $hero->setTranslations('email_placeholder', [
            'en'    => 'Enter your email address',
            'ja'    => 'メールアドレスを入力',
            'ko'    => '이메일 주소를 입력하세요',
            'es'    => 'Ingresa tu correo electrónico',
            'zh-TW' => '輸入您的電子郵件地址',
            'vi'    => 'Nhập địa chỉ email của bạn',
        ]);
        $hero->setTranslations('email_cta', [
            'en'    => 'Stay Updated',
            'ja'    => '最新情報を受け取る',
            'ko'    => '업데이트 받기',
            'es'    => 'Mantenerme Actualizado',
            'zh-TW' => '保持更新',
            'vi'    => 'Nhận Cập Nhật',
        ]);
        $hero->save();
    }

    // ─────────────────────────────────────────────
    private function seedSolutions(): void
    {
        $data = [
            'Fragmented user experience' => [
                'challenge' => [
                    'en'    => 'Fragmented user experience',
                    'ja'    => '断片化されたユーザー体験',
                    'ko'    => '분산된 사용자 경험',
                    'es'    => 'Experiencia de usuario fragmentada',
                    'zh-TW' => '分散的使用者體驗',
                    'vi'    => 'Trải nghiệm người dùng phân mảnh',
                ],
                'current_state' => [
                    'en'    => 'Managing multiple wallets, addresses, and gas tokens',
                    'ja'    => '複数のウォレット、アドレス、ガストークンの管理',
                    'ko'    => '여러 지갑, 주소, 가스 토큰 관리',
                    'es'    => 'Gestión de múltiples carteras, direcciones y tokens de gas',
                    'zh-TW' => '管理多個錢包、地址和 Gas 代幣',
                    'vi'    => 'Quản lý nhiều ví, địa chỉ và gas token',
                ],
                'aeterna_solution' => [
                    'en'    => 'Universal Address controls 15+ chains',
                    'ja'    => 'ユニバーサルアドレスで15以上のチェーンを管理',
                    'ko'    => 'Universal Address로 15개 이상의 체인 제어',
                    'es'    => 'La Dirección Universal controla más de 15 cadenas',
                    'zh-TW' => '通用地址控制 15+ 條鏈',
                    'vi'    => 'Địa chỉ Toàn cầu kiểm soát 15+ chuỗi',
                ],
            ],
            'AI integration' => [
                'challenge' => [
                    'en'    => 'AI integration',
                    'ja'    => 'AIの統合',
                    'ko'    => 'AI 통합',
                    'es'    => 'Integración de IA',
                    'zh-TW' => 'AI 整合',
                    'vi'    => 'Tích hợp AI',
                ],
                'current_state' => [
                    'en'    => 'No native AI support; centralized inference',
                    'ja'    => 'ネイティブAIサポートなし、中央集権的な推論',
                    'ko'    => '네이티브 AI 지원 없음, 중앙화된 추론',
                    'es'    => 'Sin soporte nativo de IA; inferencia centralizada',
                    'zh-TW' => '無原生 AI 支援；集中式推理',
                    'vi'    => 'Không có hỗ trợ AI gốc; suy luận tập trung',
                ],
                'aeterna_solution' => [
                    'en'    => 'Decentralized AgentCore + verifiable reasoning',
                    'ja'    => '分散型AgentCore + 検証可能な推論',
                    'ko'    => '탈중앙화 AgentCore + 검증 가능한 추론',
                    'es'    => 'AgentCore descentralizado + razonamiento verificable',
                    'zh-TW' => '去中心化 AgentCore + 可驗證推理',
                    'vi'    => 'AgentCore phi tập trung + lý luận có thể xác minh',
                ],
            ],
            'High fees' => [
                'challenge' => [
                    'en'    => 'High fees',
                    'ja'    => '高い手数料',
                    'ko'    => '높은 수수료',
                    'es'    => 'Comisiones elevadas',
                    'zh-TW' => '高額費用',
                    'vi'    => 'Phí cao',
                ],
                'current_state' => [
                    'en'    => 'Gas costs hinder daily operations',
                    'ja'    => 'ガスコストが日常業務を妨げる',
                    'ko'    => '가스 비용이 일상 운영을 방해함',
                    'es'    => 'Los costos de gas dificultan las operaciones diarias',
                    'zh-TW' => 'Gas 費用阻礙日常運作',
                    'vi'    => 'Chi phí gas cản trở hoạt động hàng ngày',
                ],
                'aeterna_solution' => [
                    'en'    => 'Resource credits enable near-zero fees',
                    'ja'    => 'リソースクレジットでほぼゼロの手数料を実現',
                    'ko'    => '리소스 크레딧으로 거의 제로 수수료 실현',
                    'es'    => 'Los créditos de recursos permiten comisiones casi nulas',
                    'zh-TW' => '資源積分實現近零費用',
                    'vi'    => 'Tín dụng tài nguyên cho phép phí gần bằng không',
                ],
            ],
            'Cross-chain complexity' => [
                'challenge' => [
                    'en'    => 'Cross-chain complexity',
                    'ja'    => 'クロスチェーンの複雑さ',
                    'ko'    => '크로스체인 복잡성',
                    'es'    => 'Complejidad entre cadenas',
                    'zh-TW' => '跨鏈複雜性',
                    'vi'    => 'Độ phức tạp xuyên chuỗi',
                ],
                'current_state' => [
                    'en'    => 'Bridges require trust assumptions',
                    'ja'    => 'ブリッジは信頼の仮定を必要とする',
                    'ko'    => '브리지는 신뢰 가정을 필요로 함',
                    'es'    => 'Los puentes requieren suposiciones de confianza',
                    'zh-TW' => '橋接需要信任假設',
                    'vi'    => 'Cầu nối yêu cầu giả định tin cậy',
                ],
                'aeterna_solution' => [
                    'en'    => 'State-machine-level chain abstraction',
                    'ja'    => 'ステートマシンレベルのチェーン抽象化',
                    'ko'    => '상태 머신 수준의 체인 추상화',
                    'es'    => 'Abstracción de cadena a nivel de máquina de estado',
                    'zh-TW' => '狀態機級別的鏈抽象',
                    'vi'    => 'Trừu tượng hóa chuỗi ở cấp độ máy trạng thái',
                ],
            ],
            'Scalability' => [
                'challenge' => [
                    'en'    => 'Scalability',
                    'ja'    => 'スケーラビリティ',
                    'ko'    => '확장성',
                    'es'    => 'Escalabilidad',
                    'zh-TW' => '可擴展性',
                    'vi'    => 'Khả năng mở rộng',
                ],
                'current_state' => [
                    'en'    => 'Traditional BFT limited to ~10K TPS',
                    'ja'    => '従来のBFTは約10K TPSに制限',
                    'ko'    => '기존 BFT는 약 10K TPS로 제한',
                    'es'    => 'BFT tradicional limitado a ~10K TPS',
                    'zh-TW' => '傳統 BFT 限制在約 10K TPS',
                    'vi'    => 'BFT truyền thống giới hạn ở ~10K TPS',
                ],
                'aeterna_solution' => [
                    'en'    => "DAG consensus reaches 160K+ TPS\r\n(Ultra-Fast Speed)",
                    'ja'    => "DAGコンセンサスで160K+ TPSを実現\n（超高速）",
                    'ko'    => "DAG 합의로 160K+ TPS 달성\n(초고속)",
                    'es'    => "El consenso DAG alcanza 160K+ TPS\n(Velocidad Ultra-Rápida)",
                    'zh-TW' => "DAG 共識達到 160K+ TPS\n（超快速度）",
                    'vi'    => "Đồng thuận DAG đạt 160K+ TPS\n(Tốc độ Siêu Nhanh)",
                ],
            ],
        ];

        foreach (Solution::all() as $solution) {
            $en = $solution->getTranslation('challenge', 'en', false);
            if (!isset($data[$en])) continue;
            $d = $data[$en];
            $solution->setTranslations('challenge', $d['challenge']);
            $solution->setTranslations('current_state', $d['current_state']);
            $solution->setTranslations('aeterna_solution', $d['aeterna_solution']);
            $solution->save();
        }
    }

    // ─────────────────────────────────────────────
    private function seedArchitecture(): void
    {
        $data = [
            'Infrastructure Layer' => [
                'name' => [
                    'en'    => 'Infrastructure Layer',
                    'ja'    => 'インフラストラクチャ層',
                    'ko'    => '인프라 레이어',
                    'es'    => 'Capa de Infraestructura',
                    'zh-TW' => '基礎設施層',
                    'vi'    => 'Tầng Cơ sở Hạ tầng',
                ],
                'description' => [
                    'en'    => 'The foundational bedrock of Aeterna — a high-performance Layer 1 built with Rust for maximum throughput, security, and determinism.',
                    'ja'    => 'Aeterna の基盤 — Rust で構築された高性能 Layer 1 で、最大スループット、セキュリティ、確定性を実現。',
                    'ko'    => 'Aeterna의 기반 — 최대 처리량, 보안, 결정론을 위해 Rust로 구축된 고성능 Layer 1.',
                    'es'    => 'La base fundamental de Aeterna — un Layer 1 de alto rendimiento construido con Rust para máximo rendimiento, seguridad y determinismo.',
                    'zh-TW' => 'Aeterna 的基礎基石 — 用 Rust 構建的高性能 Layer 1，實現最大吞吐量、安全性和確定性。',
                    'vi'    => 'Nền tảng cốt lõi của Aeterna — một Layer 1 hiệu suất cao được xây dựng bằng Rust để đạt thông lượng tối đa, bảo mật và tính xác định.',
                ],
            ],
            'AI Engine Layer' => [
                'name' => [
                    'en'    => 'AI Engine Layer',
                    'ja'    => 'AIエンジン層',
                    'ko'    => 'AI 엔진 레이어',
                    'es'    => 'Capa del Motor de IA',
                    'zh-TW' => 'AI 引擎層',
                    'vi'    => 'Tầng AI Engine',
                ],
                'description' => [
                    'en'    => "The world's first fully on-chain AI execution layer — bringing verifiable, incentivized intelligence directly into blockchain consensus.",
                    'ja'    => '世界初の完全オンチェーンAI実行層 — 検証可能でインセンティブ付きの知性をブロックチェーンコンセンサスに直接導入。',
                    'ko'    => '세계 최초의 완전 온체인 AI 실행 레이어 — 검증 가능하고 인센티브화된 인텔리전스를 블록체인 합의에 직접 가져옵니다.',
                    'es'    => 'La primera capa de ejecución de IA totalmente en cadena del mundo — trayendo inteligencia verificable e incentivada directamente al consenso blockchain.',
                    'zh-TW' => '全球首個完全鏈上 AI 執行層 — 將可驗證的激勵型智能直接帶入區塊鏈共識。',
                    'vi'    => 'Lớp thực thi AI hoàn toàn trên chuỗi đầu tiên trên thế giới — mang trí tuệ có thể xác minh và được khuyến khích trực tiếp vào sự đồng thuận blockchain.',
                ],
            ],
            'Chain Abstraction Layer' => [
                'name' => [
                    'en'    => 'Chain Abstraction Layer',
                    'ja'    => 'チェーン抽象化層',
                    'ko'    => '체인 추상화 레이어',
                    'es'    => 'Capa de Abstracción de Cadena',
                    'zh-TW' => '鏈抽象層',
                    'vi'    => 'Tầng Trừu tượng Chuỗi',
                ],
                'description' => [
                    'en'    => "One address. Every chain. Aeterna's chain abstraction layer eliminates the complexity of multi-chain interactions through intent-based execution.",
                    'ja'    => '1つのアドレス。すべてのチェーン。Aeterna のチェーン抽象化層はインテントベースの実行によりマルチチェーンの複雑さを排除。',
                    'ko'    => '하나의 주소. 모든 체인. Aeterna의 체인 추상화 레이어는 인텐트 기반 실행으로 멀티체인 상호작용의 복잡성을 제거합니다.',
                    'es'    => "Una dirección. Cada cadena. La capa de abstracción de Aeterna elimina la complejidad de las interacciones multi-cadena mediante ejecución basada en intenciones.",
                    'zh-TW' => 'Aeterna 的鏈抽象層通過基於意圖的執行消除了多鏈交互的複雜性，一個地址，每條鏈。',
                    'vi'    => 'Một địa chỉ. Mọi chuỗi. Lớp trừu tượng chuỗi của Aeterna loại bỏ sự phức tạp của các tương tác đa chuỗi thông qua thực thi dựa trên ý định.',
                ],
            ],
            'Payment & Trust Layer' => [
                'name' => [
                    'en'    => 'Payment & Trust Layer',
                    'ja'    => 'ペイメント＆トラスト層',
                    'ko'    => '결제 및 신뢰 레이어',
                    'es'    => 'Capa de Pago y Confianza',
                    'zh-TW' => '支付與信任層',
                    'vi'    => 'Tầng Thanh toán & Tin cậy',
                ],
                'description' => [
                    'en'    => 'AI-native payment infrastructure for the autonomous economy — micropayments, gas abstraction, and programmable trust for AI agents.',
                    'ja'    => '自律経済向けのAIネイティブ決済インフラ — AIエージェントのためのマイクロペイメント、ガス抽象化、プログラマブルトラスト。',
                    'ko'    => '자율 경제를 위한 AI 네이티브 결제 인프라 — AI 에이전트를 위한 마이크로페이먼트, 가스 추상화, 프로그래머블 신뢰.',
                    'es'    => 'Infraestructura de pago nativa de IA para la economía autónoma — micropagos, abstracción de gas y confianza programable para agentes de IA.',
                    'zh-TW' => '面向自主經濟的 AI 原生支付基礎設施 — AI 代理的微支付、Gas 抽象化和可編程信任。',
                    'vi'    => 'Cơ sở hạ tầng thanh toán gốc AI cho nền kinh tế tự trị — thanh toán vi mô, trừu tượng gas và niềm tin lập trình được cho các tác nhân AI.',
                ],
            ],
        ];

        foreach (ArchitectureLayer::all() as $layer) {
            $en = $layer->getTranslation('name', 'en', false);
            if (!isset($data[$en])) continue;
            $d = $data[$en];
            $layer->setTranslations('name', $d['name']);
            $layer->setTranslations('description', $d['description']);
            $layer->save();
        }
    }

    // ─────────────────────────────────────────────
    private function seedTokenomics(): void
    {
        $t = Tokenomic::first();
        if (!$t) return;

        $t->setTranslations('section_badge', [
            'en'    => 'Token Economics',
            'ja'    => 'トークノミクス',
            'ko'    => '토큰 이코노믹스',
            'es'    => 'Economía de Tokens',
            'zh-TW' => '代幣經濟學',
            'vi'    => 'Kinh tế Token',
        ]);
        $t->setTranslations('section_title', [
            'en'    => 'AETHER Tokenomics',
            'ja'    => 'AETHERトークノミクス',
            'ko'    => 'AETHER 토큰노믹스',
            'es'    => 'Tokenomics de AETHER',
            'zh-TW' => 'AETHER 代幣經濟學',
            'vi'    => 'Tokenomics của AETHER',
        ]);
        $t->setTranslations('section_subtitle', [
            'en'    => 'A deflationary economic model designed for sustainable growth, community ownership, and long-term value accrual.',
            'ja'    => '持続可能な成長、コミュニティの所有権、長期的な価値蓄積のために設計されたデフレ経済モデル。',
            'ko'    => '지속 가능한 성장, 커뮤니티 소유권, 장기적 가치 축적을 위해 설계된 디플레이션 경제 모델.',
            'es'    => 'Un modelo económico deflacionario diseñado para un crecimiento sostenible, propiedad comunitaria y acumulación de valor a largo plazo.',
            'zh-TW' => '一個通縮經濟模型，旨在實現可持續增長、社區所有權和長期價值積累。',
            'vi'    => 'Mô hình kinh tế giảm phát được thiết kế cho tăng trưởng bền vững, quyền sở hữu cộng đồng và tích lũy giá trị dài hạn.',
        ]);
        $t->save();
    }

    // ─────────────────────────────────────────────
    private function seedRoadmap(): void
    {
        $data = [
            'Foundation' => [
                'name' => ['en'=>'Foundation','ja'=>'基盤','ko'=>'기반','es'=>'Fundación','zh-TW'=>'基礎','vi'=>'Nền Tảng'],
                'timeframe' => ['en'=>'Year 1 — Q1 & Q2','ja'=>'1年目 — Q1 & Q2','ko'=>'1년차 — Q1 & Q2','es'=>'Año 1 — T1 y T2','zh-TW'=>'第1年 — Q1 & Q2','vi'=>'Năm 1 — Q1 & Q2'],
            ],
            'AI Integration' => [
                'name' => ['en'=>'AI Integration','ja'=>'AI統合','ko'=>'AI 통합','es'=>'Integración de IA','zh-TW'=>'AI 整合','vi'=>'Tích Hợp AI'],
                'timeframe' => ['en'=>'Year 1 — Q3 & Q4','ja'=>'1年目 — Q3 & Q4','ko'=>'1년차 — Q3 & Q4','es'=>'Año 1 — T3 y T4','zh-TW'=>'第1年 — Q3 & Q4','vi'=>'Năm 1 — Q3 & Q4'],
            ],
            'Chain Abstraction' => [
                'name' => ['en'=>'Chain Abstraction','ja'=>'チェーン抽象化','ko'=>'체인 추상화','es'=>'Abstracción de Cadena','zh-TW'=>'鏈抽象','vi'=>'Trừu Tượng Chuỗi'],
                'timeframe' => ['en'=>'Year 2 — Q1 & Q2','ja'=>'2年目 — Q1 & Q2','ko'=>'2년차 — Q1 & Q2','es'=>'Año 2 — T1 y T2','zh-TW'=>'第2年 — Q1 & Q2','vi'=>'Năm 2 — Q1 & Q2'],
            ],
            'Ecosystem Expansion' => [
                'name' => ['en'=>'Ecosystem Expansion','ja'=>'エコシステム拡大','ko'=>'생태계 확장','es'=>'Expansión del Ecosistema','zh-TW'=>'生態系統擴展','vi'=>'Mở Rộng Hệ Sinh Thái'],
                'timeframe' => ['en'=>'Year 2 — Q3+','ja'=>'2年目 — Q3+','ko'=>'2년차 — Q3+','es'=>'Año 2 — T3+','zh-TW'=>'第2年 — Q3+','vi'=>'Năm 2 — Q3+'],
            ],
        ];

        foreach (RoadmapStage::all() as $stage) {
            $en = $stage->getTranslation('name', 'en', false);
            if (!isset($data[$en])) continue;
            $stage->setTranslations('name', $data[$en]['name']);
            $stage->setTranslations('timeframe', $data[$en]['timeframe']);
            $stage->save();
        }
    }

    // ─────────────────────────────────────────────
    private function seedUseCases(): void
    {
        $data = [
            'D-Commerce' => [
                'title' => ['en'=>'D-Commerce','ja'=>'D-コマース','ko'=>'D-커머스','es'=>'D-Commerce','zh-TW'=>'D-Commerce','vi'=>'D-Commerce'],
                'description' => [
                    'en'    => 'Decentralized e-commerce infrastructure that eliminates platform intermediaries. Sellers keep 99.9% of revenue with fees of only 0.02–0.1%, versus traditional 15–40% platform cuts.',
                    'ja'    => '分散型eコマースインフラで、プラットフォームの仲介者を排除。販売者は収益の99.9%を維持し、手数料はわずか0.02〜0.1%（従来の15〜40%と比較）。',
                    'ko'    => '플랫폼 중개자를 제거하는 탈중앙화 전자상거래 인프라. 판매자는 수익의 99.9%를 유지하며 수수료는 0.02~0.1%에 불과합니다(기존 15~40% 대비).',
                    'es'    => 'Infraestructura de comercio electrónico descentralizada que elimina los intermediarios de plataforma. Los vendedores mantienen el 99.9% de los ingresos con comisiones de solo 0.02-0.1%, frente a los recortes del 15-40% de las plataformas tradicionales.',
                    'zh-TW' => '去中心化電商基礎設施，消除平台中介。賣家保留99.9%的收入，費用僅為0.02-0.1%，相比傳統平台的15-40%。',
                    'vi'    => 'Cơ sở hạ tầng thương mại điện tử phi tập trung loại bỏ các trung gian nền tảng. Người bán giữ 99.9% doanh thu với phí chỉ 0.02-0.1%, so với mức 15-40% của nền tảng truyền thống.',
                ],
            ],
            'Tokenized Real Estate' => [
                'title' => ['en'=>'Tokenized Real Estate','ja'=>'トークン化不動産','ko'=>'토큰화 부동산','es'=>'Bienes Raíces Tokenizados','zh-TW'=>'代幣化房地產','vi'=>'Bất Động Sản Token Hóa'],
                'description' => [
                    'en'    => 'Fractional ownership of global real estate through ERC-1155 property NFTs. Invest in prime real estate with as little as $10, powered by AI property management.',
                    'ja'    => 'ERC-1155不動産NFTによるグローバル不動産の分割所有。わずか$10からプライム不動産に投資可能で、AIによる不動産管理を実現。',
                    'ko'    => 'ERC-1155 부동산 NFT를 통한 글로벌 부동산 분할 소유. AI 부동산 관리로 $10부터 핵심 부동산에 투자하세요.',
                    'es'    => 'Propiedad fraccionada de bienes raíces globales a través de NFTs de propiedades ERC-1155. Invierte en bienes raíces de primera con tan solo $10, impulsado por gestión de propiedades con IA.',
                    'zh-TW' => '通過ERC-1155房產NFT實現全球房地產分割所有權。由AI物業管理支持，最低$10即可投資優質房地產。',
                    'vi'    => 'Sở hữu phân đoạn bất động sản toàn cầu thông qua NFT bất động sản ERC-1155. Đầu tư vào bất động sản hàng đầu với chỉ $10, được hỗ trợ bởi quản lý tài sản AI.',
                ],
            ],
            'Open UBI' => [
                'title' => ['en'=>'Open UBI','ja'=>'オープンUBI','ko'=>'오픈 UBI','es'=>'UBI Abierto','zh-TW'=>'開放 UBI','vi'=>'UBI Mở'],
                'description' => [
                    'en'    => 'Sustainable Universal Basic Income through network participation. Earn by contributing data, attention, and compute — a new economic model for the AI age.',
                    'ja'    => 'ネットワーク参加を通じた持続可能なユニバーサルベーシックインカム。データ、注意力、コンピュートを提供して収入を得る — AI時代の新しい経済モデル。',
                    'ko'    => '네트워크 참여를 통한 지속 가능한 기본소득. 데이터, 관심, 컴퓨팅을 제공하여 수익 획득 — AI 시대의 새로운 경제 모델.',
                    'es'    => 'Renta Básica Universal sostenible a través de la participación en la red. Gana contribuyendo datos, atención y cómputo — un nuevo modelo económico para la era de la IA.',
                    'zh-TW' => '通過網絡參與實現可持續的全民基本收入。通過貢獻數據、注意力和計算獲得收益 — AI時代的新經濟模型。',
                    'vi'    => 'Thu nhập cơ bản phổ quát bền vững thông qua tham gia mạng lưới. Kiếm tiền bằng cách đóng góp dữ liệu, sự chú ý và tính toán — mô hình kinh tế mới cho kỷ nguyên AI.',
                ],
            ],
            'AI Service Economy' => [
                'title' => ['en'=>'AI Service Economy','ja'=>'AIサービスエコノミー','ko'=>'AI 서비스 경제','es'=>'Economía de Servicios de IA','zh-TW'=>'AI 服務經濟','vi'=>'Nền Kinh tế Dịch vụ AI'],
                'description' => [
                    'en'    => 'A marketplace for AI agents to monetize services autonomously. Deploy AI agents that earn revenue 24/7 without human intervention using the x402 payment protocol.',
                    'ja'    => 'AIエージェントが自律的にサービスを収益化するマーケットプレイス。x402支払いプロトコルを使用して人間の介入なしに24時間365日収益を得るAIエージェントをデプロイ。',
                    'ko'    => 'AI 에이전트가 자율적으로 서비스를 수익화하는 마켓플레이스. x402 결제 프로토콜을 사용하여 인간 개입 없이 24/7 수익을 창출하는 AI 에이전트를 배포하세요.',
                    'es'    => 'Un mercado para que los agentes de IA moneticen servicios de forma autónoma. Implementa agentes de IA que generan ingresos 24/7 sin intervención humana usando el protocolo de pago x402.',
                    'zh-TW' => 'AI代理自主變現服務的市場。使用x402支付協議部署無需人工干預即可全天候獲得收入的AI代理。',
                    'vi'    => 'Thị trường để các tác nhân AI kiếm tiền từ dịch vụ một cách tự chủ. Triển khai các tác nhân AI kiếm doanh thu 24/7 không cần sự can thiệp của con người bằng giao thức thanh toán x402.',
                ],
            ],
        ];

        foreach (UseCase::all() as $useCase) {
            $en = $useCase->getTranslation('title', 'en', false);
            if (!isset($data[$en])) continue;
            $useCase->setTranslations('title', $data[$en]['title']);
            $useCase->setTranslations('description', $data[$en]['description']);
            $useCase->save();
        }
    }

    // ─────────────────────────────────────────────
    private function seedNavItems(): void
    {
        $data = [
            'Architecture' => ['ja'=>'アーキテクチャ','ko'=>'아키텍처','es'=>'Arquitectura','zh-TW'=>'架構','vi'=>'Kiến Trúc'],
            'Solutions'    => ['ja'=>'ソリューション','ko'=>'솔루션','es'=>'Soluciones','zh-TW'=>'解決方案','vi'=>'Giải Pháp'],
            'Exchange'     => ['ja'=>'取引所','ko'=>'거래소','es'=>'Intercambio','zh-TW'=>'交易所','vi'=>'Sàn Giao Dịch'],
            'Use Cases'    => ['ja'=>'ユースケース','ko'=>'사용 사례','es'=>'Casos de Uso','zh-TW'=>'使用案例','vi'=>'Trường Hợp Sử Dụng'],
            'Infrastructure'=>['ja'=>'インフラストラクチャ','ko'=>'인프라','es'=>'Infraestructura','zh-TW'=>'基礎設施','vi'=>'Cơ Sở Hạ Tầng'],
            'AI Engine'    => ['ja'=>'AIエンジン','ko'=>'AI 엔진','es'=>'Motor de IA','zh-TW'=>'AI 引擎','vi'=>'AI Engine'],
            'Abstraction'  => ['ja'=>'抽象化','ko'=>'추상화','es'=>'Abstracción','zh-TW'=>'抽象','vi'=>'Trừu Tượng'],
            'Payment'      => ['ja'=>'ペイメント','ko'=>'결제','es'=>'Pago','zh-TW'=>'支付','vi'=>'Thanh Toán'],
            'Aeterna DAG'  => ['ja'=>'Aeterna DAG','ko'=>'Aeterna DAG','es'=>'Aeterna DAG','zh-TW'=>'Aeterna DAG','vi'=>'Aeterna DAG'],
            'Multi-VM'     => ['ja'=>'マルチVM','ko'=>'멀티 VM','es'=>'Multi-VM','zh-TW'=>'多重 VM','vi'=>'Đa VM'],
        ];

        foreach (NavItem::all() as $nav) {
            $en = $nav->getTranslation('label', 'en', false);
            if (!isset($data[$en])) continue;
            $translations = array_merge(['en' => $en], $data[$en]);
            $nav->setTranslations('label', $translations);
            $nav->save();
        }
    }

    // ─────────────────────────────────────────────
    private function seedFooterLinks(): void
    {
        $groups = [
            'Developers' => ['ja'=>'開発者','ko'=>'개발자','es'=>'Desarrolladores','zh-TW'=>'開發者','vi'=>'Nhà Phát Triển'],
            'Ecosystem'  => ['ja'=>'エコシステム','ko'=>'생태계','es'=>'Ecosistema','zh-TW'=>'生態系統','vi'=>'Hệ Sinh Thái'],
            'Community'  => ['ja'=>'コミュニティ','ko'=>'커뮤니티','es'=>'Comunidad','zh-TW'=>'社群','vi'=>'Cộng Đồng'],
            'Legal'      => ['ja'=>'法務','ko'=>'법적','es'=>'Legal','zh-TW'=>'法律','vi'=>'Pháp Lý'],
        ];

        $labels = [
            'Whitepaper'       => ['ja'=>'ホワイトペーパー','ko'=>'백서','es'=>'Documento Técnico','zh-TW'=>'白皮書','vi'=>'Sách Trắng'],
            'GitHub'           => ['ja'=>'GitHub','ko'=>'GitHub','es'=>'GitHub','zh-TW'=>'GitHub','vi'=>'GitHub'],
            'Aeterna SDK'      => ['ja'=>'Aeterna SDK','ko'=>'Aeterna SDK','es'=>'Aeterna SDK','zh-TW'=>'Aeterna SDK','vi'=>'Aeterna SDK'],
            'Faucet'           => ['ja'=>'フォーセット','ko'=>'파우셋','es'=>'Grifo','zh-TW'=>'水龍頭','vi'=>'Vòi'],
            'Aeterna Subnet'   => ['ja'=>'Aeterna Subnet','ko'=>'Aeterna Subnet','es'=>'Aeterna Subnet','zh-TW'=>'Aeterna Subnet','vi'=>'Aeterna Subnet'],
            'Aeterna Inference'=> ['ja'=>'Aeterna Inference','ko'=>'Aeterna Inference','es'=>'Aeterna Inference','zh-TW'=>'Aeterna Inference','vi'=>'Aeterna Inference'],
            'Aeterna Storage'  => ['ja'=>'Aeterna Storage','ko'=>'Aeterna Storage','es'=>'Aeterna Storage','zh-TW'=>'Aeterna Storage','vi'=>'Aeterna Storage'],
            'Explorer'         => ['ja'=>'エクスプローラー','ko'=>'탐색기','es'=>'Explorador','zh-TW'=>'探索器','vi'=>'Trình Khám Phá'],
            'Discord'          => ['ja'=>'Discord','ko'=>'Discord','es'=>'Discord','zh-TW'=>'Discord','vi'=>'Discord'],
            'X/Twitter'        => ['ja'=>'X/Twitter','ko'=>'X/Twitter','es'=>'X/Twitter','zh-TW'=>'X/Twitter','vi'=>'X/Twitter'],
            'Telegram'         => ['ja'=>'Telegram','ko'=>'Telegram','es'=>'Telegram','zh-TW'=>'Telegram','vi'=>'Telegram'],
            'Blog'             => ['ja'=>'ブログ','ko'=>'블로그','es'=>'Blog','zh-TW'=>'部落格','vi'=>'Blog'],
            'Careers'          => ['ja'=>'採用情報','ko'=>'채용','es'=>'Empleo','zh-TW'=>'職業機會','vi'=>'Tuyển Dụng'],
            'Privacy Policy'   => ['ja'=>'プライバシーポリシー','ko'=>'개인정보처리방침','es'=>'Política de Privacidad','zh-TW'=>'隱私政策','vi'=>'Chính Sách Bảo Mật'],
            'Terms of Service' => ['ja'=>'利用規約','ko'=>'이용약관','es'=>'Términos de Servicio','zh-TW'=>'服務條款','vi'=>'Điều Khoản Dịch Vụ'],
        ];

        foreach (FooterLink::all() as $link) {
            $enGroup = $link->getTranslation('group_name', 'en', false);
            $enLabel = $link->getTranslation('label', 'en', false);

            if (isset($groups[$enGroup])) {
                $link->setTranslations('group_name', array_merge(['en' => $enGroup], $groups[$enGroup]));
            }
            if (isset($labels[$enLabel])) {
                $link->setTranslations('label', array_merge(['en' => $enLabel], $labels[$enLabel]));
            }
            $link->save();
        }
    }

    // ─────────────────────────────────────────────
    private function seedExplorerPages(): void
    {
        $tagMap = [
            'Core + AI' => ['ja'=>'コア + AI','ko'=>'코어 + AI','es'=>'Núcleo + IA','zh-TW'=>'核心 + AI','vi'=>'Lõi + AI'],
            'Core'      => ['ja'=>'コア','ko'=>'코어','es'=>'Núcleo','zh-TW'=>'核心','vi'=>'Lõi'],
            'AI Native' => ['ja'=>'AIネイティブ','ko'=>'AI 네이티브','es'=>'IA Nativa','zh-TW'=>'AI 原生','vi'=>'AI Gốc'],
        ];

        $data = [
            'Network Overview' => [
                'title' => ['en'=>'Network Overview','ja'=>'ネットワーク概要','ko'=>'네트워크 개요','es'=>'Resumen de Red','zh-TW'=>'網絡概覽','vi'=>'Tổng Quan Mạng'],
                'description' => ['en'=>'TPS / finality / epoch, latest blocks & tx, AI subsystem activity strip.','ja'=>'TPS / ファイナリティ / エポック、最新ブロック & TX、AIサブシステムアクティビティ。','ko'=>'TPS / 완결성 / 에포크, 최신 블록 & 트랜잭션, AI 서브시스템 활동.','es'=>'TPS / finalidad / época, últimos bloques y tx, tira de actividad del subsistema de IA.','zh-TW'=>'TPS / 最終性 / 紀元，最新區塊和交易，AI 子系統活動條。','vi'=>'TPS / tính hoàn thành / epoch, khối và giao dịch mới nhất, dải hoạt động hệ thống con AI.'],
            ],
            'Checkpoint Detail' => [
                'title' => ['en'=>'Checkpoint Detail','ja'=>'チェックポイント詳細','ko'=>'체크포인트 상세','es'=>'Detalle de Punto de Control','zh-TW'=>'檢查點詳情','vi'=>'Chi Tiết Checkpoint'],
                'description' => ['en'=>'Overview key-values + the transactions contained in the checkpoint.','ja'=>'概要キーバリュー + チェックポイント内のトランザクション。','ko'=>'개요 키-값 + 체크포인트에 포함된 트랜잭션.','es'=>'Valores clave generales + las transacciones contenidas en el punto de control.','zh-TW'=>'概覽鍵值 + 檢查點中包含的交易。','vi'=>'Các giá trị khóa tổng quan + các giao dịch trong checkpoint.'],
            ],
            'Transaction (PTB)' => [
                'title' => ['en'=>'Transaction (PTB)','ja'=>'トランザクション (PTB)','ko'=>'트랜잭션 (PTB)','es'=>'Transacción (PTB)','zh-TW'=>'交易 (PTB)','vi'=>'Giao Dịch (PTB)'],
                'description' => ['en'=>'PTB command sequence timeline + object changes & events, OCC-annotated.','ja'=>'PTBコマンドシーケンスタイムライン + オブジェクト変更 & イベント、OCC注釈付き。','ko'=>'PTB 명령 시퀀스 타임라인 + 객체 변경 및 이벤트, OCC 주석.','es'=>'Línea de tiempo de secuencia de comandos PTB + cambios de objetos y eventos, anotado por OCC.','zh-TW'=>'PTB 命令序列時間線 + 對象更改和事件，OCC 標注。','vi'=>'Dòng thời gian chuỗi lệnh PTB + thay đổi đối tượng & sự kiện, chú thích OCC.'],
            ],
            'Agent Detail' => [
                'title' => ['en'=>'Agent Detail','ja'=>'エージェント詳細','ko'=>'에이전트 상세','es'=>'Detalle del Agente','zh-TW'=>'代理詳情','vi'=>'Chi Tiết Tác Nhân'],
                'description' => ['en'=>'Reputation, skill portfolio with derived_from lineage, citation revenue.','ja'=>'評判、derived_from系譜付きスキルポートフォリオ、引用収益。','ko'=>'평판, derived_from 계보를 가진 스킬 포트폴리오, 인용 수익.','es'=>'Reputación, portafolio de habilidades con linaje derived_from, ingresos por citación.','zh-TW'=>'聲譽、帶有 derived_from 系譜的技能組合、引用收益。','vi'=>'Danh tiếng, danh mục kỹ năng với dòng dõi derived_from, doanh thu trích dẫn.'],
            ],
            'Cross-chain Account' => [
                'title' => ['en'=>'Cross-chain Account','ja'=>'クロスチェーンアカウント','ko'=>'크로스체인 계정','es'=>'Cuenta Multicadena','zh-TW'=>'跨鏈帳戶','vi'=>'Tài Khoản Xuyên Chuỗi'],
                'description' => ['en'=>'Derived BTC/ETH/Sol/Cosmos/TON addresses, intents, MPC signatures.','ja'=>'派生したBTC/ETH/Sol/Cosmos/TONアドレス、インテント、MPC署名。','ko'=>'파생된 BTC/ETH/Sol/Cosmos/TON 주소, 인텐트, MPC 서명.','es'=>'Direcciones BTC/ETH/Sol/Cosmos/TON derivadas, intenciones, firmas MPC.','zh-TW'=>'衍生的 BTC/ETH/Sol/Cosmos/TON 地址、意圖、MPC 簽名。','vi'=>'Địa chỉ BTC/ETH/Sol/Cosmos/TON phái sinh, ý định, chữ ký MPC.'],
            ],
            'Skill Market + Capsule Lineage' => [
                'title' => ['en'=>'Skill Market + Capsule Lineage','ja'=>'スキルマーケット + カプセル系譜','ko'=>'스킬 마켓 + 캡슐 계보','es'=>'Mercado de Habilidades + Linaje de Cápsulas','zh-TW'=>'技能市場 + 膠囊系譜','vi'=>'Thị Trường Kỹ Năng + Dòng Dõi Capsule'],
                'description' => ['en'=>'Skill economy table + Capsule evolution timeline (compress/fork/merge/forget).','ja'=>'スキルエコノミーテーブル + カプセル進化タイムライン（圧縮/フォーク/マージ/削除）。','ko'=>'스킬 경제 테이블 + 캡슐 진화 타임라인 (압축/포크/병합/삭제).','es'=>'Tabla de economía de habilidades + línea de tiempo de evolución de cápsulas (comprimir/bifurcar/fusionar/olvidar).','zh-TW'=>'技能經濟表 + 膠囊進化時間線（壓縮/分叉/合併/遺忘）。','vi'=>'Bảng kinh tế kỹ năng + dòng thời gian tiến hóa Capsule (nén/rẽ nhánh/gộp/quên).'],
            ],
            'Account Detail' => [
                'title' => ['en'=>'Account Detail','ja'=>'アカウント詳細','ko'=>'계정 상세','es'=>'Detalle de Cuenta','zh-TW'=>'帳戶詳情','vi'=>'Chi Tiết Tài Khoản'],
                'description' => ['en'=>'Balance, owned objects & tx history decoded into AI-native semantics.','ja'=>'残高、保有オブジェクト & TX履歴をAIネイティブセマンティクスでデコード。','ko'=>'잔액, 소유 객체 및 TX 기록을 AI 네이티브 의미론으로 디코딩.','es'=>'Saldo, objetos propios e historial de tx decodificado en semántica nativa de IA.','zh-TW'=>'餘額、擁有的對象和交易歷史解碼為 AI 原生語義。','vi'=>'Số dư, đối tượng sở hữu & lịch sử giao dịch được giải mã thành ngữ nghĩa AI gốc.'],
            ],
            'Validators & Network' => [
                'title' => ['en'=>'Validators & Network','ja'=>'バリデーター & ネットワーク','ko'=>'검증자 & 네트워크','es'=>'Validadores y Red','zh-TW'=>'驗證者 & 網絡','vi'=>'Người Xác Thực & Mạng'],
                'description' => ['en'=>'Network stats + validator set table (stake / voting % / APY / status).','ja'=>'ネットワーク統計 + バリデーターセットテーブル（ステーク / 投票% / APY / ステータス）。','ko'=>'네트워크 통계 + 검증자 집합 테이블 (스테이크 / 투표% / APY / 상태).','es'=>'Estadísticas de red + tabla del conjunto de validadores (stake / % de votación / APY / estado).','zh-TW'=>'網絡統計 + 驗證者集合表（質押 / 投票% / APY / 狀態）。','vi'=>'Thống kê mạng + bảng tập hợp người xác thực (cổ phần / % bỏ phiếu / APY / trạng thái).'],
            ],
        ];

        foreach (ExplorerPage::all() as $page) {
            $en = $page->getTranslation('title', 'en', false);
            if (!isset($data[$en])) continue;

            $page->setTranslations('title', $data[$en]['title']);
            $page->setTranslations('description', $data[$en]['description']);

            $enTag = $page->getTranslation('tag', 'en', false);
            if (isset($tagMap[$enTag])) {
                $page->setTranslations('tag', array_merge(['en' => $enTag], $tagMap[$enTag]));
            }
            $page->save();
        }
    }
}
