<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeroSection;
use App\Models\ArchitectureLayer;
use App\Models\Tokenomic;
use App\Models\RoadmapStage;
use App\Models\UseCase;

class JsonTranslationsSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedHeroStats();
        $this->seedArchitectureFeatures();
        $this->seedTokenomicsJson();
        $this->seedRoadmapMilestones();
        $this->seedUseCaseFeatures();
    }

    // ───────────────────────────────────────────────
    // HERO STATS
    // ───────────────────────────────────────────────
    private function seedHeroStats(): void
    {
        $hero = HeroSection::first();
        if (!$hero) return;

        $en = json_decode($hero->getTranslation('stats_json', 'en', false) ?? '[]', true) ?? [];

        $translations = [
            'ja' => $this->buildStats([
                ['value' => '160K+', 'label' => 'オンチェーンAI', 'description' => '毎秒トランザクション'],
                ['value' => '160K+', 'label' => 'TPS', 'description' => '毎秒トランザクション処理'],
                ['value' => '15+',   'label' => '対応チェーン数', 'description' => '接続済みブロックチェーン'],
                ['value' => '<100ms','label' => 'ファイナリティ', 'description' => 'トランザクション確定速度'],
            ], $en),
            'ko' => $this->buildStats([
                ['value' => '160K+', 'label' => '온체인 AI', 'description' => '초당 트랜잭션'],
                ['value' => '160K+', 'label' => 'TPS', 'description' => '초당 트랜잭션 처리량'],
                ['value' => '15+',   'label' => '지원 체인', 'description' => '연결된 블록체인'],
                ['value' => '<100ms','label' => '완결성', 'description' => '트랜잭션 확인 시간'],
            ], $en),
            'es' => $this->buildStats([
                ['value' => '160K+', 'label' => 'IA ON-CHAIN', 'description' => 'Transacciones por segundo'],
                ['value' => '160K+', 'label' => 'TPS', 'description' => 'Transacciones por segundo'],
                ['value' => '15+',   'label' => 'Cadenas', 'description' => 'Blockchains conectadas'],
                ['value' => '<100ms','label' => 'Finalidad', 'description' => 'Confirmación de transacción'],
            ], $en),
            'zh-TW' => $this->buildStats([
                ['value' => '160K+', 'label' => '鏈上 AI', 'description' => '每秒交易數'],
                ['value' => '160K+', 'label' => 'TPS', 'description' => '每秒交易處理量'],
                ['value' => '15+',   'label' => '支援鏈數', 'description' => '已連接的區塊鏈'],
                ['value' => '<100ms','label' => '最終確認', 'description' => '交易確認速度'],
            ], $en),
            'vi' => $this->buildStats([
                ['value' => '160K+', 'label' => 'AI ON-CHAIN', 'description' => 'Giao dịch mỗi giây'],
                ['value' => '160K+', 'label' => 'TPS', 'description' => 'Xử lý giao dịch mỗi giây'],
                ['value' => '15+',   'label' => 'Chuỗi hỗ trợ', 'description' => 'Blockchain được kết nối'],
                ['value' => '<100ms','label' => 'Tính cuối cùng', 'description' => 'Xác nhận giao dịch'],
            ], $en),
        ];

        $all = array_merge(['en' => $hero->getTranslation('stats_json', 'en', false)], $translations);
        $hero->setTranslations('stats_json', $all);
        $hero->save();
    }

    private function buildStats(array $localeStats, array $enStats): string
    {
        $merged = [];
        foreach ($enStats as $i => $enStat) {
            $merged[] = array_merge($enStat, $localeStats[$i] ?? []);
        }
        return json_encode($merged, JSON_UNESCAPED_UNICODE);
    }

    // ───────────────────────────────────────────────
    // ARCHITECTURE FEATURES
    // ───────────────────────────────────────────────
    private function seedArchitectureFeatures(): void
    {
        $allFeatures = [
            1 => [
                'ja' => [
                    ['title' => 'Aeterna コア',      'description' => '160K+ TPSのスループット — HotStuffベースのBFTコンセンサス。'],
                    ['title' => 'Aeterna DAG',        'description' => '並列トランザクション処理のための有向非巡回グラフ。'],
                    ['title' => 'BFTコンセンサス',   'description' => '最大1/3の悪意あるノードに対するビザンチン耐性。'],
                    ['title' => 'データ可用性',       'description' => '分散型ストレージによる高可用性データアクセス。'],
                    ['title' => 'マルチVMサポート',   'description' => 'EVM・MoveVM・SVM等の複数仮想マシンをサポート。'],
                    ['title' => '分散型ストレージ',  'description' => 'オンチェーンで分散管理される永続的なデータストレージ。'],
                ],
                'ko' => [
                    ['title' => 'Aeterna 코어',       'description' => '160K+ TPS 처리량 — HotStuff 기반 BFT 합의.'],
                    ['title' => 'Aeterna DAG',         'description' => '병렬 트랜잭션 처리를 위한 방향성 비순환 그래프.'],
                    ['title' => 'BFT 합의',            'description' => '악의적 노드 1/3까지 허용하는 비잔틴 내결함성.'],
                    ['title' => '데이터 가용성',       'description' => '분산 스토리지를 통한 고가용성 데이터 접근.'],
                    ['title' => '멀티 VM 지원',        'description' => 'EVM·MoveVM·SVM 등 다중 가상 머신 지원.'],
                    ['title' => '분산형 스토리지',     'description' => '온체인에서 분산 관리되는 영구적 데이터 스토리지.'],
                ],
                'es' => [
                    ['title' => 'Aeterna Core',        'description' => 'Rendimiento de 160K+ TPS — Consenso BFT basado en HotStuff.'],
                    ['title' => 'Aeterna DAG',          'description' => 'Grafo acíclico dirigido para procesamiento paralelo de transacciones.'],
                    ['title' => 'Consenso BFT',         'description' => 'Tolerancia a fallos bizantinos hasta 1/3 de nodos maliciosos.'],
                    ['title' => 'Disponibilidad de datos', 'description' => 'Acceso de alta disponibilidad a datos mediante almacenamiento distribuido.'],
                    ['title' => 'Soporte Multi-VM',     'description' => 'Compatibilidad con EVM, MoveVM, SVM y más.'],
                    ['title' => 'Almacenamiento descentralizado', 'description' => 'Almacenamiento persistente gestionado de forma descentralizada on-chain.'],
                ],
                'zh-TW' => [
                    ['title' => 'Aeterna 核心',        'description' => '160K+ TPS 吞吐量 — 基於 HotStuff 的 BFT 共識。'],
                    ['title' => 'Aeterna DAG',          'description' => '用於並行交易處理的有向無環圖。'],
                    ['title' => 'BFT 共識',             'description' => '可容忍最多 1/3 惡意節點的拜占庭容錯機制。'],
                    ['title' => '數據可用性',           'description' => '透過分散式存儲實現高可用性數據訪問。'],
                    ['title' => '多 VM 支持',           'description' => '支援 EVM、MoveVM、SVM 等多種虛擬機器。'],
                    ['title' => '去中心化存儲',         'description' => '鏈上去中心化管理的持久性數據存儲。'],
                ],
                'vi' => [
                    ['title' => 'Aeterna Core',         'description' => 'Thông lượng 160K+ TPS — Đồng thuận BFT dựa trên HotStuff.'],
                    ['title' => 'Aeterna DAG',           'description' => 'Đồ thị có hướng không chu trình để xử lý giao dịch song song.'],
                    ['title' => 'Đồng thuận BFT',       'description' => 'Khả năng chịu lỗi Byzantine cho đến 1/3 nút độc hại.'],
                    ['title' => 'Khả dụng dữ liệu',    'description' => 'Truy cập dữ liệu khả dụng cao qua lưu trữ phân tán.'],
                    ['title' => 'Hỗ trợ đa VM',         'description' => 'Tương thích với EVM, MoveVM, SVM và nhiều hơn nữa.'],
                    ['title' => 'Lưu trữ phi tập trung','description' => 'Lưu trữ dữ liệu lâu dài được quản lý phi tập trung trên chuỗi.'],
                ],
            ],
            2 => [
                'ja' => [
                    ['title' => 'オンチェーンオーケストレーター', 'description' => 'AIエージェントのオンチェーンタスク調整エンジン。'],
                    ['title' => 'Aeterna 推論',         'description' => '分散型ネットワークによる検証可能なAI推論。'],
                    ['title' => 'Aeterna サブネット',   'description' => 'AIモデル専用の高速分離サブネット。'],
                    ['title' => 'Aeterna メモリ',       'description' => 'AIエージェントのための永続的オンチェーンメモリ。'],
                    ['title' => 'A2Aプロトコル',        'description' => 'エージェント間の安全な通信プロトコル。'],
                    ['title' => '検証可能な計算',       'description' => 'ゼロ知識証明による計算の正確性の検証。'],
                ],
                'ko' => [
                    ['title' => '온체인 오케스트레이터', 'description' => 'AI 에이전트의 온체인 작업 조정 엔진.'],
                    ['title' => 'Aeterna 추론',          'description' => '분산 네트워크를 통한 검증 가능한 AI 추론.'],
                    ['title' => 'Aeterna 서브넷',        'description' => 'AI 모델 전용 고속 격리 서브넷.'],
                    ['title' => 'Aeterna 메모리',        'description' => 'AI 에이전트를 위한 영구적 온체인 메모리.'],
                    ['title' => 'A2A 프로토콜',          'description' => '에이전트 간 안전한 통신 프로토콜.'],
                    ['title' => '검증 가능한 컴퓨팅',    'description' => '영지식 증명을 통한 계산 정확성 검증.'],
                ],
                'es' => [
                    ['title' => 'Orquestador On-chain', 'description' => 'Motor de coordinación de tareas on-chain para agentes de IA.'],
                    ['title' => 'Aeterna Inferencia',   'description' => 'Inferencia de IA verificable mediante red distribuida.'],
                    ['title' => 'Aeterna Subred',       'description' => 'Subred de alta velocidad y aislada para modelos de IA.'],
                    ['title' => 'Aeterna Memoria',      'description' => 'Memoria persistente on-chain para agentes de IA.'],
                    ['title' => 'Protocolo A2A',        'description' => 'Protocolo de comunicación segura entre agentes.'],
                    ['title' => 'Cómputo Verificable',  'description' => 'Verificación de exactitud computacional mediante pruebas de conocimiento cero.'],
                ],
                'zh-TW' => [
                    ['title' => '鏈上調度器',           'description' => 'AI 代理的鏈上任務調度引擎。'],
                    ['title' => 'Aeterna 推理',         'description' => '透過分散式網絡進行可驗證的 AI 推理。'],
                    ['title' => 'Aeterna 子網',         'description' => '專為 AI 模型設計的高速隔離子網。'],
                    ['title' => 'Aeterna 記憶體',       'description' => '供 AI 代理使用的持久性鏈上記憶體。'],
                    ['title' => 'A2A 協議',             'description' => '代理間的安全通信協議。'],
                    ['title' => '可驗證計算',           'description' => '透過零知識證明驗證計算正確性。'],
                ],
                'vi' => [
                    ['title' => 'Bộ điều phối On-chain','description' => 'Động cơ điều phối tác vụ on-chain cho AI agent.'],
                    ['title' => 'Aeterna Inference',    'description' => 'Suy luận AI có thể xác minh qua mạng phân tán.'],
                    ['title' => 'Aeterna Subnet',       'description' => 'Mạng con tốc độ cao và cô lập dành cho mô hình AI.'],
                    ['title' => 'Aeterna Memory',       'description' => 'Bộ nhớ on-chain bền vững cho AI agent.'],
                    ['title' => 'Giao thức A2A',        'description' => 'Giao thức giao tiếp an toàn giữa các agent.'],
                    ['title' => 'Tính toán có thể xác minh', 'description' => 'Xác minh độ chính xác tính toán bằng bằng chứng không có kiến thức.'],
                ],
            ],
            3 => [
                'ja' => [
                    ['title' => 'ユニバーサルアドレス',  'description' => '15以上のチェーンで単一アドレスを使用。'],
                    ['title' => 'ソルバーネットワーク',  'description' => 'クロスチェーン取引を最適化するソルバーの分散ネットワーク。'],
                    ['title' => 'MPC不要の鍵導出',       'description' => 'マルチパーティ計算なしの安全なクロスチェーン署名。'],
                    ['title' => 'インテントエンジン',    'description' => 'ユーザーのインテントを最適なクロスチェーン実行パスに変換。'],
                    ['title' => '15以上のチェーン対応', 'description' => 'パーミッションレスで拡張可能なクロスチェーン接続性。'],
                    ['title' => 'クロスチェーン流動性', 'description' => '複数チェーン間の流動性統合・最適化。'],
                ],
                'ko' => [
                    ['title' => '유니버설 주소',         'description' => '15개 이상의 체인에서 단일 주소 사용.'],
                    ['title' => '솔버 네트워크',         'description' => '크로스체인 거래를 최적화하는 분산 솔버 네트워크.'],
                    ['title' => 'MPC 없는 키 파생',      'description' => '다자간 계산 없이 안전한 크로스체인 서명.'],
                    ['title' => '인텐트 엔진',           'description' => '사용자 인텐트를 최적의 크로스체인 실행 경로로 변환.'],
                    ['title' => '15개+ 체인 지원',       'description' => '무허가 확장 가능한 크로스체인 연결성.'],
                    ['title' => '크로스체인 유동성',     'description' => '여러 체인 간 유동성 통합 및 최적화.'],
                ],
                'es' => [
                    ['title' => 'Dirección Universal',  'description' => 'Usa una sola dirección en más de 15 cadenas.'],
                    ['title' => 'Red de Solvers',        'description' => 'Red distribuida de solvers que optimizan transacciones cross-chain.'],
                    ['title' => 'Derivación sin MPC',   'description' => 'Firma cross-chain segura sin computación multipartita.'],
                    ['title' => 'Motor de Intents',     'description' => 'Convierte intents de usuario en rutas de ejecución cross-chain óptimas.'],
                    ['title' => 'Soporte 15+ Cadenas',  'description' => 'Conectividad cross-chain extensible sin permisos.'],
                    ['title' => 'Liquidez Cross-Chain', 'description' => 'Agregación y optimización de liquidez entre múltiples cadenas.'],
                ],
                'zh-TW' => [
                    ['title' => '通用地址',             'description' => '在 15 條以上鏈上使用單一地址。'],
                    ['title' => '解算器網絡',           'description' => '優化跨鏈交易的分散式解算器網絡。'],
                    ['title' => '無 MPC 密鑰派生',      'description' => '無需多方計算的安全跨鏈簽名。'],
                    ['title' => '意圖引擎',             'description' => '將用戶意圖轉換為最佳跨鏈執行路徑。'],
                    ['title' => '支援 15+ 條鏈',        'description' => '無需許可的可擴展跨鏈連接性。'],
                    ['title' => '跨鏈流動性',           'description' => '多鏈間的流動性聚合與優化。'],
                ],
                'vi' => [
                    ['title' => 'Địa chỉ toàn cầu',    'description' => 'Sử dụng một địa chỉ duy nhất trên 15+ chuỗi.'],
                    ['title' => 'Mạng Solver',          'description' => 'Mạng solver phân tán tối ưu hóa giao dịch cross-chain.'],
                    ['title' => 'Dẫn xuất khóa không MPC', 'description' => 'Chữ ký cross-chain an toàn không cần tính toán đa bên.'],
                    ['title' => 'Động cơ Intent',       'description' => 'Chuyển đổi intent người dùng thành đường dẫn thực thi cross-chain tối ưu.'],
                    ['title' => 'Hỗ trợ 15+ Chuỗi',    'description' => 'Kết nối cross-chain có thể mở rộng không cần quyền.'],
                    ['title' => 'Thanh khoản Cross-Chain', 'description' => 'Tổng hợp và tối ưu hóa thanh khoản giữa nhiều chuỗi.'],
                ],
            ],
            4 => [
                'ja' => [
                    ['title' => 'Aeterna AP2',          'description' => 'AIエージェントの自律的なHTTP決済を可能にするプロトコル。'],
                    ['title' => 'x402プロトコル',       'description' => '支払いが必要なHTTP 402レスポンスコード決済標準。'],
                    ['title' => 'ペイマスター',         'description' => 'ガス代のスポンサーシップと代替決済ロジック。'],
                    ['title' => 'リソースクレジット',   'description' => 'トークンをデプロイするためのステーキングベースのリソース。'],
                    ['title' => 'ストリーミング決済',   'description' => 'リアルタイムのマイクロペイメントストリーム。'],
                    ['title' => 'プライバシー決済',     'description' => 'ゼロ知識証明による秘匿性の高い決済。'],
                ],
                'ko' => [
                    ['title' => 'Aeterna AP2',           'description' => 'AI 에이전트의 자율 HTTP 결제를 가능하게 하는 프로토콜.'],
                    ['title' => 'x402 프로토콜',          'description' => '결제 필요 HTTP 402 응답 코드 결제 표준.'],
                    ['title' => '페이마스터',            'description' => '가스비 후원 및 대체 결제 로직.'],
                    ['title' => '리소스 크레딧',         'description' => '토큰 배포를 위한 스테이킹 기반 리소스.'],
                    ['title' => '스트리밍 결제',         'description' => '실시간 마이크로페이먼트 스트림.'],
                    ['title' => '프라이버시 결제',       'description' => '영지식 증명을 통한 비공개 결제.'],
                ],
                'es' => [
                    ['title' => 'Aeterna AP2',           'description' => 'Protocolo que habilita pagos HTTP autónomos para agentes de IA.'],
                    ['title' => 'Protocolo x402',        'description' => 'Estándar de pago para código de respuesta HTTP 402 con pago requerido.'],
                    ['title' => 'Paymaster',             'description' => 'Patrocinio de gas y lógica de pago alternativa.'],
                    ['title' => 'Créditos de Recursos',  'description' => 'Recursos basados en staking para desplegar tokens.'],
                    ['title' => 'Pagos en Streaming',    'description' => 'Flujo de micropagos en tiempo real.'],
                    ['title' => 'Pagos Privados',        'description' => 'Pagos confidenciales mediante pruebas de conocimiento cero.'],
                ],
                'zh-TW' => [
                    ['title' => 'Aeterna AP2',           'description' => '讓 AI 代理自主進行 HTTP 支付的協議。'],
                    ['title' => 'x402 協議',             'description' => '需要付款的 HTTP 402 響應代碼支付標準。'],
                    ['title' => '付款主控',             'description' => 'Gas 費贊助及替代支付邏輯。'],
                    ['title' => '資源積分',             'description' => '用於部署代幣的質押型資源。'],
                    ['title' => '串流支付',             'description' => '實時微支付串流。'],
                    ['title' => '隱私支付',             'description' => '透過零知識證明進行的機密支付。'],
                ],
                'vi' => [
                    ['title' => 'Aeterna AP2',           'description' => 'Giao thức cho phép AI agent thực hiện thanh toán HTTP tự động.'],
                    ['title' => 'Giao thức x402',        'description' => 'Tiêu chuẩn thanh toán cho mã phản hồi HTTP 402 yêu cầu thanh toán.'],
                    ['title' => 'Paymaster',             'description' => 'Tài trợ phí gas và logic thanh toán thay thế.'],
                    ['title' => 'Tín chỉ tài nguyên',   'description' => 'Tài nguyên dựa trên staking để triển khai token.'],
                    ['title' => 'Thanh toán phát trực tiếp', 'description' => 'Luồng micropayment thời gian thực.'],
                    ['title' => 'Thanh toán riêng tư',  'description' => 'Thanh toán bảo mật bằng bằng chứng không có kiến thức.'],
                ],
            ],
        ];

        foreach ($allFeatures as $layerNum => $localeData) {
            $layer = ArchitectureLayer::where('layer_number', $layerNum)->first();
            if (!$layer) continue;

            $enJson = $layer->getTranslation('features_json', 'en', false);
            $enFeatures = json_decode($enJson ?? '[]', true) ?? [];

            $translations = ['en' => $enJson];
            foreach ($localeData as $locale => $items) {
                $built = [];
                foreach ($enFeatures as $i => $enFeat) {
                    $built[] = array_merge($enFeat, $items[$i] ?? []);
                }
                $translations[$locale] = json_encode($built, JSON_UNESCAPED_UNICODE);
            }
            $layer->setTranslations('features_json', $translations);
            $layer->save();
        }
    }

    // ───────────────────────────────────────────────
    // TOKENOMICS JSON FIELDS
    // ───────────────────────────────────────────────
    private function seedTokenomicsJson(): void
    {
        $t = Tokenomic::first();
        if (!$t) return;

        // STATS
        $statsEn = json_decode($t->getTranslation('stats_json', 'en', false) ?? '[]', true) ?? [];
        $statsTranslations = [
            'en' => $t->getTranslation('stats_json', 'en', false),
            'ja' => json_encode([
                array_merge($statsEn[0] ?? [], ['label' => 'TPS',             'description' => '毎秒トランザクション処理']),
                array_merge($statsEn[1] ?? [], ['label' => 'チェーン数',      'description' => '接続済みブロックチェーン']),
                array_merge($statsEn[2] ?? [], ['label' => 'ファイナリティ',  'description' => 'トランザクション確定']),
                array_merge($statsEn[3] ?? [], ['label' => 'プロトコル手数料','description' => '最小DEX手数料']),
            ], JSON_UNESCAPED_UNICODE),
            'ko' => json_encode([
                array_merge($statsEn[0] ?? [], ['label' => 'TPS',          'description' => '초당 트랜잭션 처리']),
                array_merge($statsEn[1] ?? [], ['label' => '체인 수',       'description' => '연결된 블록체인']),
                array_merge($statsEn[2] ?? [], ['label' => '완결성',        'description' => '트랜잭션 확인']),
                array_merge($statsEn[3] ?? [], ['label' => '프로토콜 수수료','description' => '최소 DEX 수수료']),
            ], JSON_UNESCAPED_UNICODE),
            'es' => json_encode([
                array_merge($statsEn[0] ?? [], ['label' => 'TPS',              'description' => 'Transacciones por segundo']),
                array_merge($statsEn[1] ?? [], ['label' => 'Cadenas',          'description' => 'Blockchains conectadas']),
                array_merge($statsEn[2] ?? [], ['label' => 'Finalidad',        'description' => 'Confirmación de transacción']),
                array_merge($statsEn[3] ?? [], ['label' => 'Comisión Protocolo','description' => 'Comisión mínima DEX']),
            ], JSON_UNESCAPED_UNICODE),
            'zh-TW' => json_encode([
                array_merge($statsEn[0] ?? [], ['label' => 'TPS',       'description' => '每秒交易處理量']),
                array_merge($statsEn[1] ?? [], ['label' => '鏈數',      'description' => '已連接區塊鏈']),
                array_merge($statsEn[2] ?? [], ['label' => '最終確認',  'description' => '交易確認速度']),
                array_merge($statsEn[3] ?? [], ['label' => '協議費用',  'description' => '最低 DEX 費用']),
            ], JSON_UNESCAPED_UNICODE),
            'vi' => json_encode([
                array_merge($statsEn[0] ?? [], ['label' => 'TPS',             'description' => 'Giao dịch mỗi giây']),
                array_merge($statsEn[1] ?? [], ['label' => 'Số chuỗi',        'description' => 'Blockchain được kết nối']),
                array_merge($statsEn[2] ?? [], ['label' => 'Tính cuối cùng',  'description' => 'Xác nhận giao dịch']),
                array_merge($statsEn[3] ?? [], ['label' => 'Phí giao thức',   'description' => 'Phí DEX tối thiểu']),
            ], JSON_UNESCAPED_UNICODE),
        ];
        $t->setTranslations('stats_json', $statsTranslations);

        // ALLOCATION
        $allocEn = json_decode($t->getTranslation('allocation_json', 'en', false) ?? '[]', true) ?? [];
        $allocLabels = [
            'ja'    => ['エコシステム報酬', '財団準備金', '一般販売', 'チームアドバイザー', '戦略準備金'],
            'ko'    => ['생태계 보상', '재단 준비금', '공개 판매', '팀·어드바이저', '전략 준비금'],
            'es'    => ['Ecosistema y Recompensas', 'Reserva de la Fundación', 'Venta Pública', 'Equipo y Asesores', 'Reserva Estratégica'],
            'zh-TW' => ['生態系統與獎勵', '基金會儲備', '公開發售', '團隊與顧問', '戰略儲備'],
            'vi'    => ['Hệ sinh thái & Phần thưởng', 'Dự trữ Quỹ', 'Bán công khai', 'Đội ngũ & Cố vấn', 'Dự trữ Chiến lược'],
        ];
        $allocTranslations = ['en' => $t->getTranslation('allocation_json', 'en', false)];
        foreach ($allocLabels as $locale => $labels) {
            $built = [];
            foreach ($allocEn as $i => $item) {
                $built[] = array_merge($item, ['label' => $labels[$i] ?? $item['label']]);
            }
            $allocTranslations[$locale] = json_encode($built, JSON_UNESCAPED_UNICODE);
        }
        $t->setTranslations('allocation_json', $allocTranslations);

        // FLYWHEEL STEPS
        $flywheelTranslations = [
            'en' => $t->getTranslation('flywheel_steps_json', 'en', false),
            'ja' => json_encode([
                'ネットワーク利用増加',
                'トランザクション手数料の発生',
                'プロトコル料金の一部をバーン',
                '希少性の向上',
                'AETHERの価値増大',
                '追加検証者の誘致',
                'ネットワーク安全性の向上',
                'より多くのdAppsの誘致',
                'さらなるネットワーク安全性と利用増加',
            ], JSON_UNESCAPED_UNICODE),
            'ko' => json_encode([
                '네트워크 사용량 증가',
                '거래 수수료 발생',
                '프로토콜 수수료 일부 소각',
                '희소성 증가',
                'AETHER 가치 증대',
                '추가 검증자 유치',
                '네트워크 보안 강화',
                '더 많은 dApp 유치',
                '더 많은 네트워크 보안 및 사용량',
            ], JSON_UNESCAPED_UNICODE),
            'es' => json_encode([
                'El uso de la red crece',
                'Se generan comisiones de transacción',
                'Parte de las comisiones del protocolo se queman',
                'Aumenta la escasez',
                'El valor de AETHER se incrementa',
                'Se atraen más validadores',
                'La seguridad de la red mejora',
                'Se atraen más dApps',
                'Más seguridad y uso de la red',
            ], JSON_UNESCAPED_UNICODE),
            'zh-TW' => json_encode([
                '網絡使用量增長',
                '產生交易費用',
                '部分協議費用被銷毀',
                '稀缺性提升',
                'AETHER 價值增加',
                '吸引更多驗證者',
                '提升網絡安全性',
                '吸引更多 dApp',
                '更多網絡安全與使用量',
            ], JSON_UNESCAPED_UNICODE),
            'vi' => json_encode([
                'Sử dụng mạng tăng trưởng',
                'Phí giao dịch được tạo ra',
                'Một phần phí giao thức được đốt',
                'Sự khan hiếm tăng lên',
                'Giá trị AETHER tăng',
                'Thu hút thêm validator',
                'Bảo mật mạng được cải thiện',
                'Thu hút thêm dApp',
                'Bảo mật và sử dụng mạng nhiều hơn',
            ], JSON_UNESCAPED_UNICODE),
        ];
        $t->setTranslations('flywheel_steps_json', $flywheelTranslations);

        // MECHANICS
        $mechEn = json_decode($t->getTranslation('mechanics_json', 'en', false) ?? '[]', true) ?? [];
        $mechData = [
            'ja' => [
                ['title' => 'リソースクレジットシステム',  'description' => 'ステーキングでリソースを確保し、ガス代なしで取引を実行。'],
                ['title' => 'コミュニティバイバック&バーン','description' => 'DAOが管理する自動バイバック・バーンメカニズム。'],
                ['title' => 'アンチセル圧力メカニズム',    'description' => '長期保有を奨励し、売り圧力を削減する設計。'],
                ['title' => 'リキッドステーキング (lstAETHER)', 'description' => 'ステーク資産の流動性を保ちながら報酬を獲得。'],
            ],
            'ko' => [
                ['title' => '리소스 크레딧 시스템',       'description' => '스테이킹으로 리소스를 확보하고 가스비 없이 거래 실행.'],
                ['title' => '커뮤니티 바이백 & 소각',     'description' => 'DAO가 관리하는 자동 바이백 및 소각 메커니즘.'],
                ['title' => '매도 압력 방지 메커니즘',     'description' => '장기 보유를 장려하고 매도 압력을 줄이는 설계.'],
                ['title' => '리퀴드 스테이킹 (lstAETHER)','description' => '스테이킹 자산의 유동성을 유지하면서 보상 획득.'],
            ],
            'es' => [
                ['title' => 'Sistema de Créditos de Recursos', 'description' => 'Haz staking para asegurar recursos y ejecutar transacciones sin gas.'],
                ['title' => 'Recompra y Quema Comunitaria',     'description' => 'Mecanismo de recompra y quema automático gestionado por la DAO.'],
                ['title' => 'Mecanismo Anti-Presión de Venta',  'description' => 'Diseño que incentiva el holding a largo plazo y reduce la presión de venta.'],
                ['title' => 'Staking Líquido (lstAETHER)',      'description' => 'Mantén la liquidez de los activos en staking mientras obtienes recompensas.'],
            ],
            'zh-TW' => [
                ['title' => '資源積分系統',               'description' => '透過質押獲取資源，無需 Gas 費即可執行交易。'],
                ['title' => '社群回購與銷毀',             'description' => '由 DAO 管理的自動回購銷毀機制。'],
                ['title' => '抗拋售壓力機制',             'description' => '鼓勵長期持有並降低拋售壓力的設計。'],
                ['title' => '流動質押 (lstAETHER)',        'description' => '在保持質押資產流動性的同時獲取獎勵。'],
            ],
            'vi' => [
                ['title' => 'Hệ thống tín chỉ tài nguyên', 'description' => 'Stake để bảo đảm tài nguyên và thực hiện giao dịch không cần gas.'],
                ['title' => 'Mua lại & Đốt của cộng đồng', 'description' => 'Cơ chế mua lại và đốt tự động được DAO quản lý.'],
                ['title' => 'Cơ chế chống áp lực bán',     'description' => 'Thiết kế khuyến khích nắm giữ dài hạn và giảm áp lực bán.'],
                ['title' => 'Staking thanh khoản (lstAETHER)', 'description' => 'Duy trì tính thanh khoản của tài sản stake trong khi kiếm phần thưởng.'],
            ],
        ];
        $mechTranslations = ['en' => $t->getTranslation('mechanics_json', 'en', false)];
        foreach ($mechData as $locale => $items) {
            $built = [];
            foreach ($mechEn as $i => $enItem) {
                $built[] = array_merge($enItem, $items[$i] ?? []);
            }
            $mechTranslations[$locale] = json_encode($built, JSON_UNESCAPED_UNICODE);
        }
        $t->setTranslations('mechanics_json', $mechTranslations);

        $t->save();
    }

    // ───────────────────────────────────────────────
    // ROADMAP MILESTONES
    // ───────────────────────────────────────────────
    private function seedRoadmapMilestones(): void
    {
        $milestones = [
            1 => [
                'ja' => [
                    'Aeterna コアメインネット立ち上げ',
                    'Aeterna DAGの展開',
                    'BFTコンセンサスの実装',
                    'ネイティブAI推論エンジンの立ち上げ',
                    'マルチVMランタイムのサポート',
                    '開発者SDKとAPIドキュメント',
                    '初期検証者セットのオンボーディング',
                    'セキュリティ監査と公式レポート',
                ],
                'ko' => [
                    'Aeterna 코어 메인넷 출시',
                    'Aeterna DAG 배포',
                    'BFT 합의 구현',
                    '네이티브 AI 추론 엔진 출시',
                    '멀티 VM 런타임 지원',
                    '개발자 SDK 및 API 문서',
                    '초기 검증자 온보딩',
                    '보안 감사 및 공식 보고서',
                ],
                'es' => [
                    'Lanzamiento de Aeterna Core Mainnet',
                    'Despliegue de Aeterna DAG',
                    'Implementación del consenso BFT',
                    'Lanzamiento del motor de inferencia IA nativo',
                    'Soporte para runtime Multi-VM',
                    'SDK para desarrolladores y documentación API',
                    'Incorporación del conjunto inicial de validadores',
                    'Auditoría de seguridad e informe público',
                ],
                'zh-TW' => [
                    'Aeterna 核心主網上線',
                    'Aeterna DAG 部署',
                    'BFT 共識實現',
                    '原生 AI 推理引擎上線',
                    '多 VM 執行環境支援',
                    '開發者 SDK 與 API 文檔',
                    '初始驗證者集合入驗',
                    '安全審計與公開報告',
                ],
                'vi' => [
                    'Ra mắt Aeterna Core Mainnet',
                    'Triển khai Aeterna DAG',
                    'Triển khai đồng thuận BFT',
                    'Ra mắt động cơ suy luận AI bản địa',
                    'Hỗ trợ đa VM runtime',
                    'SDK nhà phát triển và tài liệu API',
                    'Giới thiệu bộ validator ban đầu',
                    'Kiểm toán bảo mật và báo cáo công khai',
                ],
            ],
            2 => [
                'ja' => [
                    'チェーン抽象化レイヤーのリリース',
                    '10以上のチェーンへの初期ブリッジ',
                    'クロスチェーンリキッドステーキング',
                    'ユニバーサルウォレット統合',
                    'インテントエンジンβ版リリース',
                    '分散型シーケンサーの展開',
                    'リレーヤーネットワークの立ち上げ',
                    '開発者グラント第1フェーズ',
                ],
                'ko' => [
                    '체인 추상화 레이어 출시',
                    '10개 이상 체인 초기 브릿지',
                    '크로스체인 리퀴드 스테이킹',
                    '유니버설 지갑 통합',
                    '인텐트 엔진 베타 출시',
                    '분산 시퀀서 배포',
                    '릴레이어 네트워크 출시',
                    '개발자 그랜트 1단계',
                ],
                'es' => [
                    'Lanzamiento de la capa de abstracción de cadena',
                    'Puentes iniciales a más de 10 cadenas',
                    'Liquid staking cross-chain',
                    'Integración de billetera universal',
                    'Lanzamiento beta del motor de intents',
                    'Despliegue del secuenciador descentralizado',
                    'Lanzamiento de la red de relayers',
                    'Primera fase de grants para desarrolladores',
                ],
                'zh-TW' => [
                    '鏈抽象層發布',
                    '初始連接 10 條以上鏈的橋接',
                    '跨鏈流動質押',
                    '通用錢包整合',
                    '意圖引擎 Beta 發布',
                    '分散式排序器部署',
                    '中繼網絡上線',
                    '開發者資助第一階段',
                ],
                'vi' => [
                    'Ra mắt lớp trừu tượng chuỗi',
                    'Cầu nối ban đầu đến 10+ chuỗi',
                    'Liquid staking cross-chain',
                    'Tích hợp ví toàn cầu',
                    'Ra mắt beta động cơ Intent',
                    'Triển khai sequencer phi tập trung',
                    'Ra mắt mạng relayer',
                    'Giai đoạn 1 tài trợ nhà phát triển',
                ],
            ],
            3 => [
                'ja' => [
                    'AIエージェントマーケットプレイスの立ち上げ',
                    'エージェント間通信(A2A)プロトコル',
                    '自律型AIガバナンスの導入',
                    'リアルワールドアセット(RWA)統合',
                    'ゼロ知識プライバシーレイヤー',
                    'オンチェーンデリバティブプロトコル',
                    '分散型オラクルネットワーク',
                    '15以上のチェーン接続の達成',
                ],
                'ko' => [
                    'AI 에이전트 마켓플레이스 출시',
                    '에이전트 간 통신(A2A) 프로토콜',
                    '자율 AI 거버넌스 도입',
                    '실물 자산(RWA) 통합',
                    '영지식 프라이버시 레이어',
                    '온체인 파생상품 프로토콜',
                    '분산형 오라클 네트워크',
                    '15개 이상 체인 연결 달성',
                ],
                'es' => [
                    'Lanzamiento del marketplace de agentes IA',
                    'Protocolo de comunicación entre agentes (A2A)',
                    'Gobernanza autónoma de IA',
                    'Integración de activos del mundo real (RWA)',
                    'Capa de privacidad de conocimiento cero',
                    'Protocolo de derivados on-chain',
                    'Red de oráculos descentralizada',
                    'Conexión a más de 15 cadenas alcanzada',
                ],
                'zh-TW' => [
                    'AI 代理市場上線',
                    '代理間通信(A2A)協議',
                    '自主 AI 治理引入',
                    '現實世界資產(RWA)整合',
                    '零知識隱私層',
                    '鏈上衍生品協議',
                    '分散式預言機網絡',
                    '實現 15 條以上鏈連接',
                ],
                'vi' => [
                    'Ra mắt marketplace AI agent',
                    'Giao thức truyền thông giữa các agent (A2A)',
                    'Quản trị AI tự chủ',
                    'Tích hợp tài sản thực (RWA)',
                    'Lớp bảo mật không kiến thức',
                    'Giao thức phái sinh on-chain',
                    'Mạng oracle phi tập trung',
                    'Đạt kết nối 15+ chuỗi',
                ],
            ],
            4 => [
                'ja' => [
                    'Aeterna 2.0プロトコルのアップグレード',
                    '完全な自律型DAOガバナンス',
                    'クロスチェーンNFTとデジタルID',
                    '分散型AIトレーニング市場',
                    '量子耐性暗号化の研究',
                    'グローバル決済ネットワークの統合',
                    'エンタープライズグレードのSLA',
                    '次世代コンセンサスメカニズムの研究',
                ],
                'ko' => [
                    'Aeterna 2.0 프로토콜 업그레이드',
                    '완전 자율 DAO 거버넌스',
                    '크로스체인 NFT 및 디지털 ID',
                    '분산형 AI 학습 마켓플레이스',
                    '양자 내성 암호화 연구',
                    '글로벌 결제 네트워크 통합',
                    '엔터프라이즈 급 SLA',
                    '차세대 합의 메커니즘 연구',
                ],
                'es' => [
                    'Actualización del protocolo Aeterna 2.0',
                    'Gobernanza DAO completamente autónoma',
                    'NFTs cross-chain e identidad digital',
                    'Marketplace de entrenamiento IA descentralizado',
                    'Investigación de criptografía resistente a cuántica',
                    'Integración de red de pagos global',
                    'SLA de grado empresarial',
                    'Investigación del mecanismo de consenso de próxima generación',
                ],
                'zh-TW' => [
                    'Aeterna 2.0 協議升級',
                    '完全自主 DAO 治理',
                    '跨鏈 NFT 和數字身份',
                    '去中心化 AI 訓練市場',
                    '抗量子加密研究',
                    '全球支付網絡整合',
                    '企業級 SLA',
                    '下一代共識機制研究',
                ],
                'vi' => [
                    'Nâng cấp giao thức Aeterna 2.0',
                    'Quản trị DAO hoàn toàn tự chủ',
                    'NFT cross-chain và danh tính số',
                    'Marketplace đào tạo AI phi tập trung',
                    'Nghiên cứu mã hóa kháng lượng tử',
                    'Tích hợp mạng thanh toán toàn cầu',
                    'SLA cấp doanh nghiệp',
                    'Nghiên cứu cơ chế đồng thuận thế hệ tiếp theo',
                ],
            ],
        ];

        $stages = RoadmapStage::all()->keyBy('stage_number');
        foreach ($milestones as $stageNum => $localeData) {
            $stage = $stages->get($stageNum);
            if (!$stage) continue;

            $enJson = $stage->getTranslation('milestones_json', 'en', false);
            $translations = ['en' => $enJson];
            foreach ($localeData as $locale => $items) {
                $translations[$locale] = json_encode($items, JSON_UNESCAPED_UNICODE);
            }
            $stage->setTranslations('milestones_json', $translations);
            $stage->save();
        }
    }

    // ───────────────────────────────────────────────
    // USE CASE FEATURES
    // ───────────────────────────────────────────────
    private function seedUseCaseFeatures(): void
    {
        $useCaseFeatures = [
            // Index 0 — D-Commerce
            0 => [
                'ja' => [
                    ['title' => '自律エージェントの収益化',    'description' => 'AIエージェントがオンチェーンで自動的にサービスを提供・収益化。'],
                    ['title' => 'マイクロペイメントAPI',       'description' => 'リアルタイムAPIコール課金とストリーミング支払い。'],
                    ['title' => 'エージェントマーケットプレイス','description' => 'AIサービスを取引する分散型オープンマーケット。'],
                    ['title' => 'クロスチェーン収益',          'description' => '15以上のチェーンにまたがる統一的な収益管理。'],
                    ['title' => 'プライバシー保護型課金',      'description' => 'ゼロ知識証明による秘匿性の高い課金システム。'],
                    ['title' => 'リアルタイム決算',            'description' => '100ms以下のファイナリティで即時決済。'],
                ],
                'ko' => [
                    ['title' => '자율 에이전트 수익화',      'description' => 'AI 에이전트가 온체인에서 자동으로 서비스 제공 및 수익화.'],
                    ['title' => '마이크로페이먼트 API',       'description' => '실시간 API 호출 과금 및 스트리밍 결제.'],
                    ['title' => '에이전트 마켓플레이스',      'description' => 'AI 서비스를 거래하는 탈중앙화 오픈 마켓.'],
                    ['title' => '크로스체인 수익',            'description' => '15개 이상 체인에 걸친 통합 수익 관리.'],
                    ['title' => '프라이버시 보호 과금',       'description' => '영지식 증명을 통한 기밀 과금 시스템.'],
                    ['title' => '실시간 정산',               'description' => '100ms 이하 완결성으로 즉시 결제.'],
                ],
                'es' => [
                    ['title' => 'Monetización de Agentes Autónomos', 'description' => 'Los agentes de IA proporcionan y monetizan servicios automáticamente on-chain.'],
                    ['title' => 'API de Micropagos',                  'description' => 'Facturación de llamadas API en tiempo real y pagos en streaming.'],
                    ['title' => 'Marketplace de Agentes',             'description' => 'Mercado abierto y descentralizado para comerciar servicios de IA.'],
                    ['title' => 'Ingresos Cross-Chain',               'description' => 'Gestión unificada de ingresos en más de 15 cadenas.'],
                    ['title' => 'Facturación con Privacidad',         'description' => 'Sistema de facturación confidencial mediante pruebas de conocimiento cero.'],
                    ['title' => 'Liquidación en Tiempo Real',         'description' => 'Pago instantáneo con finalidad de menos de 100ms.'],
                ],
                'zh-TW' => [
                    ['title' => '自主代理變現',       'description' => 'AI 代理自動在鏈上提供服務並變現。'],
                    ['title' => '微支付 API',         'description' => '實時 API 調用計費和串流支付。'],
                    ['title' => '代理市場',           'description' => '交易 AI 服務的去中心化開放市場。'],
                    ['title' => '跨鏈收益',           'description' => '跨 15 條以上鏈的統一收益管理。'],
                    ['title' => '隱私保護計費',       'description' => '透過零知識證明的機密計費系統。'],
                    ['title' => '實時結算',           'description' => '100ms 以內最終確認的即時結算。'],
                ],
                'vi' => [
                    ['title' => 'Kiếm tiền từ AI agent tự chủ', 'description' => 'AI agent tự động cung cấp dịch vụ và kiếm tiền on-chain.'],
                    ['title' => 'API micropayment',              'description' => 'Thanh toán theo cuộc gọi API thời gian thực và thanh toán phát trực tiếp.'],
                    ['title' => 'Marketplace agent',             'description' => 'Thị trường mở phi tập trung để giao dịch dịch vụ AI.'],
                    ['title' => 'Doanh thu cross-chain',         'description' => 'Quản lý doanh thu thống nhất trên 15+ chuỗi.'],
                    ['title' => 'Thanh toán bảo mật',           'description' => 'Hệ thống thanh toán bảo mật bằng bằng chứng không kiến thức.'],
                    ['title' => 'Quyết toán thời gian thực',    'description' => 'Thanh toán ngay lập tức với tính cuối cùng dưới 100ms.'],
                ],
            ],
            // Index 1 — Tokenized Real Estate
            1 => [
                'ja' => [
                    ['title' => 'リアルワールドアセットのトークン化', 'description' => '不動産をオンチェーントークンとして表現。'],
                    ['title' => 'フラクショナルオーナーシップ',       'description' => '少額から不動産への分散投資を実現。'],
                    ['title' => 'コンプライアンス自動化',             'description' => 'KYC/AMLをスマートコントラクトで自動処理。'],
                    ['title' => '収益分配',                           'description' => '家賃収入をトークン保有者にリアルタイム配分。'],
                    ['title' => 'クロスボーダー取引',                 'description' => '国境を越えた不動産投資をシームレスに実現。'],
                    ['title' => 'オンチェーン登記',                   'description' => '所有権を改ざん不可能なブロックチェーンに記録。'],
                ],
                'ko' => [
                    ['title' => '실물 자산 토큰화',      'description' => '부동산을 온체인 토큰으로 표현.'],
                    ['title' => '분할 소유권',           'description' => '소액으로 부동산 분산 투자 실현.'],
                    ['title' => '컴플라이언스 자동화',   'description' => 'KYC/AML을 스마트 컨트랙트로 자동 처리.'],
                    ['title' => '수익 분배',             'description' => '임대 수익을 토큰 보유자에게 실시간 배분.'],
                    ['title' => '국경 초월 거래',        'description' => '국경을 넘어 부동산 투자를 원활하게 실현.'],
                    ['title' => '온체인 등기',           'description' => '소유권을 변경 불가능한 블록체인에 기록.'],
                ],
                'es' => [
                    ['title' => 'Tokenización de Activos del Mundo Real', 'description' => 'Representar bienes inmuebles como tokens on-chain.'],
                    ['title' => 'Propiedad Fraccionada',                   'description' => 'Inversión fraccionada en inmuebles desde pequeños montos.'],
                    ['title' => 'Automatización del Cumplimiento',         'description' => 'Procesamiento automático de KYC/AML con contratos inteligentes.'],
                    ['title' => 'Distribución de Ingresos',                'description' => 'Distribución en tiempo real de ingresos por alquiler a los titulares.'],
                    ['title' => 'Transacciones Transfronterizas',          'description' => 'Inversión inmobiliaria transfronteriza sin fricciones.'],
                    ['title' => 'Registro On-chain',                       'description' => 'Registro inmutable de la propiedad en blockchain.'],
                ],
                'zh-TW' => [
                    ['title' => '現實世界資產代幣化', 'description' => '將房地產表示為鏈上代幣。'],
                    ['title' => '分割所有權',         'description' => '從小額開始實現房地產分散投資。'],
                    ['title' => '合規自動化',         'description' => '透過智能合約自動處理 KYC/AML。'],
                    ['title' => '收益分配',           'description' => '將租金收入即時分配給代幣持有者。'],
                    ['title' => '跨境交易',           'description' => '無縫實現跨境房地產投資。'],
                    ['title' => '鏈上登記',           'description' => '在不可篡改的區塊鏈上記錄所有權。'],
                ],
                'vi' => [
                    ['title' => 'Token hóa tài sản thực',    'description' => 'Biểu diễn bất động sản dưới dạng token on-chain.'],
                    ['title' => 'Sở hữu phân tách',           'description' => 'Đầu tư phân tán bất động sản từ số tiền nhỏ.'],
                    ['title' => 'Tự động hóa tuân thủ',       'description' => 'Xử lý KYC/AML tự động bằng hợp đồng thông minh.'],
                    ['title' => 'Phân phối doanh thu',        'description' => 'Phân phối thu nhập cho thuê cho người nắm giữ token theo thời gian thực.'],
                    ['title' => 'Giao dịch xuyên biên giới',  'description' => 'Đầu tư bất động sản xuyên biên giới liền mạch.'],
                    ['title' => 'Đăng ký on-chain',           'description' => 'Ghi lại quyền sở hữu trên blockchain không thể thay đổi.'],
                ],
            ],
            // Index 2 — Open UBI
            2 => [
                'ja' => [
                    ['title' => 'ユニバーサルベーシックインカム', 'description' => 'DeFi収益から自動的にUBIを生成・分配。'],
                    ['title' => 'プログラマブル配分',             'description' => 'スマートコントラクトによる自動収益分配。'],
                    ['title' => 'IDチェーン',                     'description' => 'Sybil攻撃を防ぐ分散型ID確認システム。'],
                    ['title' => 'グローバルアクセス',             'description' => '銀行口座なしで全世界からアクセス可能。'],
                    ['title' => 'DeFi収益生成',                  'description' => 'ステーキング・レンディング・流動性から収益を生成。'],
                    ['title' => 'コミュニティガバナンス',         'description' => 'UBIパラメータをDAOで民主的に管理。'],
                ],
                'ko' => [
                    ['title' => '유니버설 기본소득',   'description' => 'DeFi 수익에서 자동으로 UBI를 생성 및 배분.'],
                    ['title' => '프로그래머블 배분',    'description' => '스마트 컨트랙트를 통한 자동 수익 배분.'],
                    ['title' => 'ID 체인',              'description' => 'Sybil 공격을 방지하는 탈중앙화 ID 확인 시스템.'],
                    ['title' => '글로벌 접근성',        'description' => '은행 계좌 없이 전 세계에서 접근 가능.'],
                    ['title' => 'DeFi 수익 생성',       'description' => '스테이킹·렌딩·유동성에서 수익 창출.'],
                    ['title' => '커뮤니티 거버넌스',    'description' => 'UBI 파라미터를 DAO로 민주적으로 관리.'],
                ],
                'es' => [
                    ['title' => 'Renta Básica Universal',      'description' => 'Generación y distribución automática de UBI desde rendimientos DeFi.'],
                    ['title' => 'Distribución Programable',    'description' => 'Distribución automática de rendimientos mediante contratos inteligentes.'],
                    ['title' => 'Cadena de Identidad',         'description' => 'Sistema descentralizado de verificación de identidad contra ataques Sybil.'],
                    ['title' => 'Acceso Global',               'description' => 'Accesible desde cualquier parte del mundo sin cuenta bancaria.'],
                    ['title' => 'Generación de Rendimiento DeFi', 'description' => 'Generación de rendimiento desde staking, préstamos y liquidez.'],
                    ['title' => 'Gobernanza Comunitaria',      'description' => 'Gestión democrática de los parámetros UBI mediante DAO.'],
                ],
                'zh-TW' => [
                    ['title' => '全民基本收入',     'description' => '從 DeFi 收益自動生成並分配 UBI。'],
                    ['title' => '可編程分配',       'description' => '透過智能合約自動分配收益。'],
                    ['title' => 'ID 鏈',            'description' => '防止 Sybil 攻擊的去中心化 ID 驗證系統。'],
                    ['title' => '全球訪問',         'description' => '無需銀行帳戶，全球任何地方可訪問。'],
                    ['title' => 'DeFi 收益生成',    'description' => '從質押、借貸和流動性中生成收益。'],
                    ['title' => '社群治理',         'description' => '透過 DAO 民主管理 UBI 參數。'],
                ],
                'vi' => [
                    ['title' => 'Thu nhập cơ bản toàn cầu', 'description' => 'Tự động tạo và phân phối UBI từ thu nhập DeFi.'],
                    ['title' => 'Phân phối có thể lập trình','description' => 'Phân phối thu nhập tự động qua hợp đồng thông minh.'],
                    ['title' => 'Chuỗi danh tính',           'description' => 'Hệ thống xác minh danh tính phi tập trung chống tấn công Sybil.'],
                    ['title' => 'Truy cập toàn cầu',         'description' => 'Có thể truy cập từ bất kỳ đâu trên thế giới không cần tài khoản ngân hàng.'],
                    ['title' => 'Tạo thu nhập DeFi',         'description' => 'Tạo thu nhập từ staking, cho vay và thanh khoản.'],
                    ['title' => 'Quản trị cộng đồng',        'description' => 'Quản lý dân chủ các tham số UBI qua DAO.'],
                ],
            ],
            // Index 3 — AI Service Economy
            3 => [
                'ja' => [
                    ['title' => '分散型AIモデルマーケット',    'description' => 'AIモデルのオープンな取引・利用プラットフォーム。'],
                    ['title' => '検証可能な推論',              'description' => 'ゼロ知識証明でAI出力の信頼性を証明。'],
                    ['title' => 'AIエージェントスタッキング',  'description' => '複数のAIエージェントを組み合わせて複雑なタスクを実行。'],
                    ['title' => 'オンチェーントレーニング',    'description' => '分散型ネットワークでAIモデルを共同トレーニング。'],
                    ['title' => 'モデル所有権NFT',             'description' => 'AIモデルをNFTとして所有・取引・ライセンス化。'],
                    ['title' => '自律型決済フロー',            'description' => 'AIサービス消費に連動した自動マイクロペイメント。'],
                ],
                'ko' => [
                    ['title' => '분산형 AI 모델 마켓',        'description' => 'AI 모델의 오픈 거래·사용 플랫폼.'],
                    ['title' => '검증 가능한 추론',            'description' => '영지식 증명으로 AI 출력의 신뢰성 증명.'],
                    ['title' => 'AI 에이전트 스태킹',          'description' => '여러 AI 에이전트를 조합해 복잡한 작업 실행.'],
                    ['title' => '온체인 트레이닝',             'description' => '분산 네트워크에서 AI 모델 공동 훈련.'],
                    ['title' => '모델 소유권 NFT',             'description' => 'AI 모델을 NFT로 소유·거래·라이센싱.'],
                    ['title' => '자율 결제 플로우',            'description' => 'AI 서비스 소비에 연동된 자동 마이크로페이먼트.'],
                ],
                'es' => [
                    ['title' => 'Mercado de Modelos IA Descentralizado', 'description' => 'Plataforma abierta para comerciar y usar modelos de IA.'],
                    ['title' => 'Inferencia Verificable',                 'description' => 'Prueba de fiabilidad de la salida de IA mediante conocimiento cero.'],
                    ['title' => 'Apilamiento de Agentes IA',             'description' => 'Combinar múltiples agentes de IA para ejecutar tareas complejas.'],
                    ['title' => 'Entrenamiento On-chain',                 'description' => 'Entrenamiento colaborativo de modelos IA en red distribuida.'],
                    ['title' => 'NFT de Propiedad del Modelo',            'description' => 'Poseer, comerciar y licenciar modelos IA como NFTs.'],
                    ['title' => 'Flujo de Pago Autónomo',                 'description' => 'Micropagos automáticos vinculados al consumo de servicios IA.'],
                ],
                'zh-TW' => [
                    ['title' => '去中心化 AI 模型市場', 'description' => '開放的 AI 模型交易和使用平台。'],
                    ['title' => '可驗證推理',           'description' => '透過零知識證明證明 AI 輸出的可靠性。'],
                    ['title' => 'AI 代理堆疊',          'description' => '組合多個 AI 代理執行複雜任務。'],
                    ['title' => '鏈上訓練',             'description' => '在分散式網絡中協同訓練 AI 模型。'],
                    ['title' => '模型所有權 NFT',       'description' => '將 AI 模型作為 NFT 擁有、交易和授權。'],
                    ['title' => '自主支付流程',         'description' => '與 AI 服務消費掛鉤的自動微支付。'],
                ],
                'vi' => [
                    ['title' => 'Thị trường mô hình AI phi tập trung', 'description' => 'Nền tảng mở để giao dịch và sử dụng mô hình AI.'],
                    ['title' => 'Suy luận có thể xác minh',             'description' => 'Chứng minh độ tin cậy đầu ra AI bằng bằng chứng không kiến thức.'],
                    ['title' => 'Xếp chồng AI agent',                   'description' => 'Kết hợp nhiều AI agent để thực hiện các tác vụ phức tạp.'],
                    ['title' => 'Đào tạo on-chain',                     'description' => 'Đào tạo cộng tác mô hình AI trên mạng phân tán.'],
                    ['title' => 'NFT quyền sở hữu mô hình',             'description' => 'Sở hữu, giao dịch và cấp phép mô hình AI dưới dạng NFT.'],
                    ['title' => 'Luồng thanh toán tự chủ',              'description' => 'Micropayment tự động liên kết với tiêu thụ dịch vụ AI.'],
                ],
            ],
        ];

        $useCases = UseCase::orderBy('sort_order')->get()->values();
        foreach ($useCaseFeatures as $index => $localeData) {
            $useCase = $useCases->get($index);
            if (!$useCase) continue;

            $enJson = $useCase->getTranslation('features_json', 'en', false);
            $enFeatures = json_decode($enJson ?? '[]', true) ?? [];

            $translations = ['en' => $enJson];
            foreach ($localeData as $locale => $items) {
                $built = [];
                foreach ($enFeatures as $i => $enFeat) {
                    $built[] = array_merge($enFeat, $items[$i] ?? []);
                }
                $translations[$locale] = json_encode($built, JSON_UNESCAPED_UNICODE);
            }
            $useCase->setTranslations('features_json', $translations);
            $useCase->save();
        }
    }
}
